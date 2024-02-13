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
