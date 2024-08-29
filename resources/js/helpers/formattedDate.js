function formattedDate(){
    let today = new Date();
    let year = today.getFullYear().toString(); // Get last two digits of year
    let month = (today.getMonth() + 1).toString().padStart(2, '0'); // Get month (add 1 because months are zero-indexed)
    let day = today.getDate().toString().padStart(2, '0'); // Get day
    let formattedDate = year +'-'+ month +'-'+ day;
    return formattedDate;
}

export default formattedDate;