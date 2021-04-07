var canvas = document.querySelector('canvas');

canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

var c = canvas.getContext('2d');

function distance(x1,y1,x2,y2){
    const xDist = x2-x1;
    const yDist = y2-y1;

    return Math.sqrt(Math.pow(xDist,2) + Math.pow(yDist, 2));
};

function Particle(x,y,radius,color){
    this.x = x;
    this.y = y;
    this.radius = radius;
    this.color = color;
    
    this.update = () => {
        this.draw();
    };

    this.draw = () => {
        c.beginPath();
        c.arc(this.x, this.y, this.radius, 0, Math.PI * 2, false);
        c.strokeStyle = this.color;
        c.stroke();
        c.closePath();
    };
};

let particles;

function init(){
    particles = [];

    for(let i=0; i< 100; i++){
        let x = Math.random() * innerWidth;
        let y = Math.random() * innerHeight;
        const radius = 10;
        const color = 'blue';

        if(i !== 0){
            for(let j=0; j<particles.length; j++){
                if((distance(x,y,particles[j].x, particles[j].y) - radius*2) < 0){
                    x = Math.random() * innerWidth;
                    y = Math.random() * innerHeight;

                    j = -1;
                }
            }
        }

        particles.push(new Particle(x,y,radius,color));
    }
}

function animate(){
    requestAnimationFrame(animate);
    c.clearRect(0,0,canvas.width,canvas.height);

    particles.forEach(particle => {
        particle.update();
    });   
}

init();
animate();
