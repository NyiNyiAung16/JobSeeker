const getMinDate = (dateString) => {
    if(!dateString) return;

    const date = new Date(dateString);
    date.setDate(date.getDate() + 1);
    let nextDayString = date.toISOString().split('T')[0];
    
    return nextDayString;
};

export default getMinDate;