// Logika Utama
const room = "Aula";
const selectedDate = "2024-02-03";
const currentDate = [
    ["Multimedia", "2024-02-03", "9", "12"],
    ["Aula", "2024-02-03", "14", "16"],
];

const matchingDateItems = currentDate.filter(
    (item) => item[0] === room && item[1] === selectedDate
);

const uniqueValues = new Set();

if (matchingDateItems.length > 0) {
    matchingDateItems.forEach((item) => {
        const index1 = parseInt(item[2]);
        const index2 = parseInt(item[3]);

        for (let i = index1; i <= index2; i++) {
            uniqueValues.add(i.toString().padStart(1, "0"));
        }
    });

    const newArray = Array.from(uniqueValues).sort(
        (a, b) => parseInt(a) - parseInt(b)
    );
    console.log(newArray);
} else {
    console.log("Tanggal atau ruangan tidak ditemukan dalam array.");
}

// Logika Kedua
const room = "Aula";
const selectedDate = "2024-02-05";
const currentDate = [
    ["Multimedia", "2024-02-03", "2024-02-03", "9", "12"],
    ["Aula", "2024-02-04", "2024-02-05", "14", "10"],
];

const matchingDateItems = currentDate.filter(
    (item) =>
        item[0] === room &&
        (item[1] === selectedDate || item[2] === selectedDate)
);

const uniqueValues = new Set();

if (matchingDateItems.length > 0) {
    matchingDateItems.forEach((item) => {
        const index1 = parseInt(item[3]);
        const index2 = parseInt(item[4]);

        if (item[1] === selectedDate && item[2] === selectedDate) {
            for (let i = index1; i <= index2; i++) {
                uniqueValues.add(i.toString().padStart(1, "0"));
            }
        } else if (item[1] === selectedDate) {
            for (let i = index1; i <= 17; i++) {
                uniqueValues.add(i.toString().padStart(1, "0"));
            }
        } else if (item[2] === selectedDate) {
            for (let i = 8; i <= index2; i++) {
                uniqueValues.add(i.toString().padStart(1, "0"));
            }
        }
    });

    const newArray = Array.from(uniqueValues).sort(
        (a, b) => parseInt(a) - parseInt(b)
    );
    console.log(newArray);
} else {
    console.log("Ruangan, tanggal, atau keduanya tidak ditemukan dalam array.");
}

// Dashboard.blade.php
function getValue() {
    const radioButton = document.getElementsByName("jam_mulai");
    const labelElement8 = document.getElementById("8-jam_mulai");
    const labelElement9 = document.getElementById("9-jam_mulai");
    const labelElement10 = document.getElementById("10-jam_mulai");
    const labelElement11 = document.getElementById("11-jam_mulai");
    const labelElement12 = document.getElementById("12-jam_mulai");
    const labelElement13 = document.getElementById("13-jam_mulai");
    const labelElement14 = document.getElementById("14-jam_mulai");
    const labelElement15 = document.getElementById("15-jam_mulai");
    const labelElement16 = document.getElementById("16-jam_mulai");

    for (let i = 0; i < radioButton.length; i++) {
        if (radioButton[i].checked) {
            const selectedValue = radioButton[i].value;

            console.log(selectedValue);

            if (
                selectedValue === "8" &&
                labelElement8.classList.contains("cursor-pointer")
            ) {
                labelElement8.style.backgroundColor = "#99f6e4";
                labelElement9.style.backgroundColor = "";
                labelElement10.style.backgroundColor = "";
                labelElement11.style.backgroundColor = "";
                labelElement12.style.backgroundColor = "";
                labelElement13.style.backgroundColor = "";
                labelElement14.style.backgroundColor = "";
                labelElement15.style.backgroundColor = "";
                labelElement16.style.backgroundColor = "";
            } else if (
                selectedValue === "9" &&
                labelElement9.classList.contains("cursor-pointer")
            ) {
                labelElement8.style.backgroundColor = "";
                labelElement9.style.backgroundColor = "#99f6e4";
                labelElement10.style.backgroundColor = "";
                labelElement11.style.backgroundColor = "";
                labelElement12.style.backgroundColor = "";
                labelElement13.style.backgroundColor = "";
                labelElement14.style.backgroundColor = "";
                labelElement15.style.backgroundColor = "";
                labelElement16.style.backgroundColor = "";
            } else if (
                selectedValue === "10" &&
                labelElement10.classList.contains("cursor-pointer")
            ) {
                labelElement8.style.backgroundColor = "";
                labelElement9.style.backgroundColor = "";
                labelElement10.style.backgroundColor = "#99f6e4";
                labelElement11.style.backgroundColor = "";
                labelElement12.style.backgroundColor = "";
                labelElement13.style.backgroundColor = "";
                labelElement14.style.backgroundColor = "";
                labelElement15.style.backgroundColor = "";
                labelElement16.style.backgroundColor = "";
            } else if (
                selectedValue === "11" &&
                labelElement11.classList.contains("cursor-pointer")
            ) {
                labelElement8.style.backgroundColor = "";
                labelElement9.style.backgroundColor = "";
                labelElement10.style.backgroundColor = "";
                labelElement11.style.backgroundColor = "#99f6e4";
                labelElement12.style.backgroundColor = "";
                labelElement13.style.backgroundColor = "";
                labelElement14.style.backgroundColor = "";
                labelElement15.style.backgroundColor = "";
                labelElement16.style.backgroundColor = "";
            } else if (
                selectedValue === "12" &&
                labelElement12.classList.contains("cursor-pointer")
            ) {
                labelElement8.style.backgroundColor = "";
                labelElement9.style.backgroundColor = "";
                labelElement10.style.backgroundColor = "";
                labelElement11.style.backgroundColor = "";
                labelElement12.style.backgroundColor = "#99f6e4";
                labelElement13.style.backgroundColor = "";
                labelElement14.style.backgroundColor = "";
                labelElement15.style.backgroundColor = "";
                labelElement16.style.backgroundColor = "";
            } else if (
                selectedValue === "13" &&
                labelElement13.classList.contains("cursor-pointer")
            ) {
                labelElement8.style.backgroundColor = "";
                labelElement9.style.backgroundColor = "";
                labelElement10.style.backgroundColor = "";
                labelElement11.style.backgroundColor = "";
                labelElement12.style.backgroundColor = "";
                labelElement13.style.backgroundColor = "#99f6e4";
                labelElement14.style.backgroundColor = "";
                labelElement15.style.backgroundColor = "";
                labelElement16.style.backgroundColor = "";
            } else if (
                selectedValue === "14" &&
                labelElement14.classList.contains("cursor-pointer")
            ) {
                labelElement8.style.backgroundColor = "";
                labelElement9.style.backgroundColor = "";
                labelElement10.style.backgroundColor = "";
                labelElement11.style.backgroundColor = "";
                labelElement12.style.backgroundColor = "";
                labelElement13.style.backgroundColor = "";
                labelElement14.style.backgroundColor = "#99f6e4";
                labelElement15.style.backgroundColor = "";
                labelElement16.style.backgroundColor = "";
            } else if (
                selectedValue === "15" &&
                labelElement15.classList.contains("cursor-pointer")
            ) {
                labelElement8.style.backgroundColor = "";
                labelElement9.style.backgroundColor = "";
                labelElement10.style.backgroundColor = "";
                labelElement11.style.backgroundColor = "";
                labelElement12.style.backgroundColor = "";
                labelElement13.style.backgroundColor = "";
                labelElement14.style.backgroundColor = "";
                labelElement15.style.backgroundColor = "#99f6e4";
                labelElement16.style.backgroundColor = "";
            } else if (
                selectedValue === "16" &&
                labelElement16.classList.contains("cursor-pointer")
            ) {
                labelElement8.style.backgroundColor = "";
                labelElement9.style.backgroundColor = "";
                labelElement10.style.backgroundColor = "";
                labelElement11.style.backgroundColor = "";
                labelElement12.style.backgroundColor = "";
                labelElement13.style.backgroundColor = "";
                labelElement14.style.backgroundColor = "";
                labelElement15.style.backgroundColor = "";
                labelElement16.style.backgroundColor = "#99f6e4";
            }
        }
    }
}
