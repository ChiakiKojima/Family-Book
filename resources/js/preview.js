$(() => {
    let year = document.getElementById('year');
    let month = document.getElementById('month');
    let day = document.getElementById('day');
    let prev = document.getElementById('prev');
    let next = document.getElementById('next');
    
    prev.onclick = function() {
        if (!month == 12) {
            month.innerHTML = '<h3>{{ $month-1 }}月<h3>';
        } else {
            year.innerHTML = '<h3>{{ $year-1 }}<h3>'
            month.innerHTML = '<h3>1月<h3>';
        }
    };
    
});