document.addEventListener('DOMContentLoaded', function() {

const canvas = document.getElementById("canvas-particles");
const ctx = canvas.getContext('2d');
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

let particlesArray;

function colorParticle(colorRed, colorBlue, colorGreen, opacity) {
    return `rgba(${colorRed}, ${colorBlue}, ${colorGreen}, ${opacity})`
}


let mouse = {
    x: null,
    y: null,
    radius: (canvas.height/120) * (canvas.width/120),
}


window.addEventListener('mousemove', 
    function(event) {
        mouse.x = event.x;
        mouse.y = event.y;
    }
);


class Particle {
    constructor(x, y, directionX, directionY, size, color) {
        this.x = x;
        this.y = y;
        this.directionX = directionX;
        this.directionY = directionY;
        this.size = size;
        this.color = color;
    }

    draw() {
        ctx.beginPath()
        ctx.fillStyle = this.color;
        ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2, false);
        ctx.fill()
        
    }

    update() {
        if (this.x > canvas.width || this.x < 0) {
            this.directionX = -this.directionX
        }

        if (this.y > canvas.height || this.y < 0) {
            this.directionY = -this.directionY
        }

        let dx = mouse.x - this.x;
        let dy = mouse.y - this.y;
        let distance = Math.sqrt(dx*dx + dy*dy);

        if (distance < mouse.radius + this.size) {
            if(mouse.x < this.x && this.x < canvas.width - this.size * 10) {
                this.x += 10;
            }
            if(mouse.x > this.x && this.x > this.size * 10) {
                this.x -= 10;
            }
            
            if(mouse.y < this.y && this.y < canvas.height - this.size *10) {
                this.y += 10;
            }
            if(mouse.y > this.y && this.y > this.size *10) {
                this.y -= 10;
            }
        }

        this.x += this.directionX;
        this.y += this.directionY;
        this.draw();
    }
}


function init() {
    particlesArray = [];
    let numberOfParticles = (canvas.height * canvas.width) / 5000;
    for (let i = 0; i < numberOfParticles; i++) {
        let size = (Math.random() * 2.5) + 1;
        let x = (Math.random() * ((innerWidth - size * 2) - (size * 2)) + size * 2);
        let y = (Math.random() * ((innerHeight - size * 2) - (size * 2)) + size * 2);
        let directionX = (Math.random() * 3) - 1.5; 
        let directionY = (Math.random() * 3) - 1.5;
        let color = colorParticle("52", "152", "219", "1")
        particlesArray.push(new Particle(x, y, directionX, directionY, size, color));
    }
}

function connect() {
    let opacityValue = 1
    for (let a = 0; a < particlesArray.length; a++) {
        for (let b = a; b < particlesArray.length; b++) {
            let distance = (( particlesArray[a].x - particlesArray[b].x)
            * (particlesArray[a].x - particlesArray[b].x))
            + ((particlesArray[a].y - particlesArray[b].y) * (particlesArray[a].y - particlesArray[b].y))

            if(distance < (canvas.width/10) * (canvas.height/10)) {
                opacityValue = 1 - (distance/20000)
                ctx.strokeStyle = colorParticle("52", "152", "219", opacityValue)
                ctx.lineWidth = 1;
                ctx.beginPath();
                ctx.moveTo(particlesArray[a].x, particlesArray[a].y)
                ctx.lineTo(particlesArray[b].x, particlesArray[b].y)
                ctx.stroke();
            }
        }
    }
}


function animate() {
    requestAnimationFrame(animate)
    ctx.clearRect(0, 0, innerWidth, innerHeight);
    for(let i = 0; i < particlesArray.length; i++) {
        particlesArray[i].update();
    }
    connect()
}

window.addEventListener('resize', 
    function() {
        canvas.height = innerHeight;
        canvas.width = innerWidth;
        mouse.radius = (canvas.height/100) * (canvas.width/100);
        init()
    }
)

window.addEventListener('mouseout',
    function() {
        mouse.x = undefined;
        mouse.y = undefined;
    })

init()
animate()

})