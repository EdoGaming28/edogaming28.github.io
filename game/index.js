const canvas = document.querySelector("canvas");
const up = document.querySelector("#atas");
const down = document.querySelector("#bawah");
const skorElement = document.querySelector("#skor");

// inisialisasi objek 2D
const ctx = canvas.getContext("2d");

// render gambar untuk car dan obstacle
let car = new Image();
car.src = "../img/car.png";
let obs = new Image();
obs.src = "../img/barrier.png";
let jalan = new Image();
jalan.src = "../img/jalan.png";

// posisi mobil
let carPos = {
    x: 35,
    y: 30,
};

// posisi obstacle
let obsPos = [];
obsPos[0] = {
    x: canvas.width,
    y: 100,
};

let score = 0;

const start = () => {
    // clear canvas dan membuat gambar mobil
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.drawImage(car, carPos.x, carPos.y);
    for (let i = 0; i < obsPos.length; i++) {
        ctx.drawImage(obs, obsPos[i].x, obsPos[i].y);
        // carPos.y++;
        obsPos[i].x--;
        // menambah obstacle saat obstacle mencapai jarak tertentu
        if (obsPos[i].x == 20) {
            obsPos.push({
                x: canvas.width,
                y: carPos.y,
            });
        }
        if (
            carPos.x + car.width >= obsPos[i].x &&
            carPos.x <= obsPos[i].x + obs.width &&
            carPos.y + car.height >= obsPos[i].y &&
            carPos.y <= obsPos[i].y + obs.height
            ) {
                location.reload();
            }
            // menambahkan score
        if (obsPos[i].x == 30) {
            score += 10;
            skorElement.textContent = `SKOR : ${score}`;
        }
    }
    requestAnimationFrame(start);
};

// up car
const upCar = () => {
    if (carPos.y >= 3) {
    carPos.y -= 10;
    }
};
// down
const downCar = () => {
    if (carPos.y <= 125) {
        carPos.y += 10;
    }
};
const checkKey = (el) => {
    if (el.keyCode == 38) {
        upCar();
    } else if (el.keyCode == 40) {
        downCar();
    }
};

// ketika keyboard atas atau bawah dipencet
document.onkeydown = checkKey;
// event handler untuk up dan down
up.addEventListener("click", upCar);
down.addEventListener("click", downCar);

start();