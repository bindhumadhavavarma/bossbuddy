var today = new Date();
var currentMonth = today.getMonth();
var currentYear = today.getFullYear();
var selectYear = document.getElementById("year");
var selectMonth = document.getElementById("month");

var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
var day = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
var fullmonths = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
var monthAndYear = document.getElementById("monthAndYear");
showCalendar(currentMonth, currentYear);


function next() {
    currentYear = (currentMonth === 11) ? currentYear + 1 : currentYear;
    currentMonth = (currentMonth + 1) % 12;
    showCalendar(currentMonth, currentYear);
}

function previous() {
    currentYear = (currentMonth === 0) ? currentYear - 1 : currentYear;
    currentMonth = (currentMonth === 0) ? 11 : currentMonth - 1;
    showCalendar(currentMonth, currentYear);
}

function jump() {
    currentYear = parseInt(selectYear.value);
    currentMonth = parseInt(selectMonth.value);
    showCalendar(currentMonth, currentYear);
}

function showCalendar(month, year) {

    var firstDay = (new Date(year, month)).getDay();
    var daysInMonth = 32 - new Date(year, month, 32).getDate();

    var tbl = document.getElementById("calendar-body"); // body of the calendar

    // clearing all previous cells
    tbl.innerHTML = "";
    var monthanddateinfo = document.createElement("h2");
    monthanddateinfo.id = "monthAndYear";
    var txt = document.createTextNode(months[month] + " " + year);
    monthanddateinfo.appendChild(txt);
    tbl.appendChild(monthanddateinfo);
    // filing data about month and in the page via DOM.
    monthAndYear.innerHTML = months[month] + " " + year;
    document.getElementById("evedate").innerHTML = day[today.getDay()] + ", " + today.getDate() + " " + fullmonths[today.getMonth()];
    selectYear.value = year;
    selectMonth.value = month;
    showevents(today.getDate(), today.getMonth(), today.getFullYear());
    // creating all cells
    var date = 1;
    for (var i = 0; i < 6; i++) {
        // creates a table row


        //creating individual cells, filing them up with data.
        for (var j = 0; j < 7; j++) {
            if (i === 0 && j < firstDay) {
                var cell = document.createElement("button");

                cell.className = "null";
                var cellText = document.createTextNode("");
                cell.appendChild(cellText);
                tbl.appendChild(cell);
            } else if (date > daysInMonth) {
                break;
            } else {
                var cell = document.createElement("button");
                cell.addEventListener("click", dateclicked)
                var cellText = document.createTextNode(date);
                if (date === today.getDate() && year === today.getFullYear() && month === today.getMonth()) {
                    cell.classList.add("today");
                } // color today's date
                cell.appendChild(cellText);
                tbl.appendChild(cell);
                date++;
            }


        }
    }

}
var current = today;

function dateclicked(clicked) {

    current = new Date(selectYear.value, selectMonth.value, this.innerHTML);
    showevents(current.getDate(), current.getMonth(), current.getFullYear());
    console.log(parseInt(this.innerHTML + " " + selectMonth));
    document.getElementById("evedate").innerHTML = day[current.getDay()] + ", " + current.getDate() + " " + fullmonths[current.getMonth()];

}

function addevent() {
    var inputtime = document.forms['addeveform']['time'].value;
    var inputdesc = document.forms['addeveform']['description'].value;
    var currentdate = current.getFullYear() + "-" + (current.getMonth() + 1) + "-" + current.getDate();
    if (inputdesc == "") {
        document.getElementById("addeventerror").innerHTML = '<div class="alert alert-danger alert-dismissible fade show" role="alert">Descripiton should not empty.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
    } else {
        $.ajax({
            type: "POST",
            url: "http://localhost/bossbuddy/APIs/addevent.php",
            data: {
                inputtime: inputtime,
                inputdesc: inputdesc,
                date: currentdate
            },
            success: function() {
                showevents(current.getDate(), current.getMonth(), current.getFullYear());
            }
        });
    }
    console.log(inputtime);
    return false;
}

function showevents(date, month, year) {
    $.ajax({
        type: "POST",
        url: "http://localhost/bossbuddy/APIs/showevents.php",
        data: {
            date: date,
            month: month + 1,
            year: year
        },
        success: function(html) {
            $("#evelist").html(html).show();
        }
    });
}

function deleteevent(sl) {
    console.log(sl);
    $.ajax({
        type: "POST",
        url: "http://localhost/bossbuddy/APIs/deleteevent.php",
        data: {
            sl: sl
        },
        success: function() {
            showevents(current.getDate(), current.getMonth(), current.getFullYear());
        }
    });
}