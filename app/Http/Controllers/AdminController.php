<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Job;
use App\Models\Location;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{
    /**
     * Display the Admin Dashboard view.
     */
    public function dashboard()
    {
        $locations = DB::table('_jobs_')
            ->select(DB::raw('count(location) as total, location as name'))
            ->where('status','approved')
            ->groupBy('location')
            ->limit(10)
            ->get(); 

        $user = User::all()->count();
        $pending = Job::where('status','pending')->get()->count();
        $approved = Job::where('status','approved')->get()->count();
        $rejected = Job::where('status','rejected')->get()->count();
        $userGrowRate = $this->getGrowthRate('users');
        $pendingJobGrowRate = $this->getGrowthRate('_jobs_','pending');
        $approvedJobGrowRate = $this->getGrowthRate('_jobs_','approved');
        $rejectedJobGrowRate = $this->getGrowthRate('_jobs_','rejected');

        $dataStats = [
            'user' => $user,
            'pending' => $pending,
            'approved' => $approved,
            'rejected' => $rejected,
            'userGrowRate' => $userGrowRate,
            'pendingJobGrowRate' => $pendingJobGrowRate,
            'approvedJobGrowRate' => $approvedJobGrowRate,
            'rejectedJobGrowRate' => $rejectedJobGrowRate,
        ];

        return inertia()->render('Admin/Dashboard',compact('locations','dataStats'));
    }


    /**
     * Display the Pending Jobs view.
     */
    public function showPendingJobs()
    {
        $pendingJobs = Job::where('status','pending')->paginate(8);
        // $approvedJobs = Job::where('status','approved')->paginate(8);
        // $rejectedJobs = Job::where('status','rejected')->paginate(8);

        return inertia()->render('Admin/JobManagement/PendingJobs',compact('pendingJobs'));
    }

    /**
     * Display the Approved Jobs view.
     */
    public function showApprovedJobs()
    {
        $approvedJobs = Job::where('status','approved')->paginate(8);

        return inertia()->render('Admin/JobManagement/ApprovedJobs',compact('approvedJobs'));
    }

    /**
     * Display the Rejected Jobs view.
     */
    public function showRejectedJobs()
    {
        $rejectedJobs = Job::where('status','rejected')->paginate(8);

        return inertia()->render('Admin/JobManagement/RejectedJobs',compact('rejectedJobs'));
    }

    /**
     * Display the Content Management View.
     */
    public function contentManagement()
    {
        $contents = Content::all();
        return inertia('Admin/ContentManagement',compact('contents'));
    }

    /**
     * destroy specific user
     */
    public function destroyUser(User $user)
    {
        $user->delete();
        return back()->with('message',[
            'type' => 'success',
            'body' => 'User successfully deleted.'
        ]);
    }

    /**
     * change status to approved from pending
     */
    public function approved(Job $job)
    {
        $job->update(['status' => 'approved']);
        return back()->with('message',[
            'type' => 'success',
            'body' => 'Job successfully approved.'
        ]);
    }

    /**
     * Change status to rejected and add rejection reason
     */
    public function rejected(Job $job,Request $request)
    {
        $cleanData =   $request->validate([
            'rejection_reason' => 'required|string'
        ]);

        $job->update(['status' => 'rejected','rejection_reason' => $cleanData['rejection_reason']]);
        return back()->with('message',[
            'type' => 'success',
            'body' => 'Job successfully rejected.'
        ]);
    }

    /**
     * Display create user form
     */
    public function userManagement()
    {
        $users = User::latest()->paginate(6);

        return inertia()->render('Admin/UserManagement',compact('users'));
    }

    /**
     * Store user data
     */
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect(route('admin.userManagement'))->with('message',[
            'type' => 'success',
            'body' => 'User successfully created.'
        ]);
    }

    /**
     * Show Edit User Form
     */
    public function userShow(User $user) 
    {
        return inertia()->render('Admin/EditUser',compact('user'));
    }

    /**
     * Update user data
     */
    public function userUpdate(Request $request,User $user)
    {
        $cleanData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'role' => 'required|in:employee,employer,admin'
        ]);

        $user->update($cleanData);
        return redirect(route('admin.userManagement'))->with('message',[
            'type' => 'success',
            'body' => 'User successfully updated.'
        ]);
    }

    public function getGrowthRate($tableName,$column = 'pending')
    {
        // Calculate the number of new users in the last month
        $lastMonth = Carbon::now()->subMonth();
        $newUsersLastMonth = $tableName === 'users' ? 
            DB::table($tableName)->where('created_at', '>=', $lastMonth)->count() 
            : 
            DB::table($tableName)->where('status',$column)->where('created_at', '>=', $lastMonth)->count();

        // Calculate the number of new users in the month before last
        $twoMonthsAgo = Carbon::now()->subMonths(2);
        $newUsersMonthBeforeLast =  $tableName === 'users' ?
            DB::table($tableName)->whereBetween('created_at', [$twoMonthsAgo, $lastMonth])->count() 
            : 
            DB::table($tableName)->where('status',$column)->whereBetween('created_at', [$twoMonthsAgo, $lastMonth])->count();

        // Calculate the growth rate
        if ($newUsersMonthBeforeLast == 0) {
            $growthRate = $newUsersLastMonth * 100; // To handle division by zero
        } else {
            $growthRate = (($newUsersLastMonth - $newUsersMonthBeforeLast) / $newUsersMonthBeforeLast) * 100;
        }

        return $growthRate;
    }
}
