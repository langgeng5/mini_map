var canvas = document.querySelector('canvas');

canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

var c = canvas.getContext('2d');


//rectange
c.fillStyle = "rgba(255,0,0,0.1)"
c.fillRect(100,100,100,100);

c.fillStyle = "rgba(255,0,0,0.5)"
c.fillRect(200,200,100,100);
 
// console.log(canvas );


//line
c.beginPath();
c.moveTo(50,300);
c.lineTo(300,100);
c.lineTo(400,300);
c.strokeStyle = "blue";
c.stroke();

//arc / circle
c.beginPath();
c.arc(300,300,30,0, Math.PI*2, false);
c.strokeStyle = "grey";
c.stroke();


var mouse = {
    x: undefined,
    y: undefined
}

var maxRadius = 40
var minRadius = 2

var colorArray = [
    'red',
    'green',
    'blue',
    'yellow'
]

window.addEventListener("mousemove", function(event){
    mouse.x = event.x
    mouse.y = event.y
})

window.addEventListener("resize", function(){
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;

    init()
})

function Circle(x,y,dx,dy,radius,color){
    this.x = x
    this.y = y
    this.dx = dx
    this.dy = dy
    this.radius = radius
    this.color = color
    this.minRadius = radius

    this.draw = function(){
        c.beginPath();
        c.arc(this.x,this.y,this.radius,0, Math.PI*2, false);
        c.strokeStyle = this.color;
        c.fillStyle = this.color
        c.stroke();
        c.fill()
    }

    this.update = function(){
        
        if((this.x + this.radius > innerWidth) || (this.x - this.radius<0)){
            this.dx = -this.dx;
        }
        if((this.y + this.radius > innerHeight) || (this.y - this.radius<0)){
            this.dy = -this.dy;
        }
        this.x += this.dx; 
        this.y += this.dy; 


        //interactivity
        if(((mouse.x - this.x) < 50) && ((mouse.x - this.x) > -50) && ((mouse.y - this.y) < 50) && ((mouse.y - this.y) > -50)){
            if(this.radius < maxRadius)
            this.radius += 1
        }else if (this.radius > this.minRadius){
            this.radius -= 1
        }

        this.draw() 
    }

}

// var circle = new Circle(200,200,5,5,30,"red")

var circleArray = []

function init(){
    get_location()
    circleArray = []

    for(var i = 0; i < 500; i++){
        var x = Math.random() * innerWidth
        var y = Math.random() * innerHeight
        var dx = (Math.random() - 0.5) * 4
        var dy = (Math.random() - 0.5) * 4
        var radius = (Math.random() * 10) + 1
    
        // var color = "rgba("+Math.random()*256+","+Math.random()*256+","+Math.random()*256+","+(Math.random()*10)/10+")"
        var color = colorArray[Math.floor(Math.random() * colorArray.length)]
    
        circleArray.push(new Circle(x,y,dx,dy,radius,color))
    }
}

function animate(){
    requestAnimationFrame(animate)
    c.clearRect(0,0,innerWidth,innerHeight);

    for(var i = 0; i < circleArray.length; i++){
        circleArray[i].update()
    }
    // circle.update()    
}

function get_location(){
    const status = document.querySelector('#status');

    var options = {
        enableHighAccuracy: true,
    };

    function success(position) {
        const latitude  = position.coords.latitude;
        const longitude = position.coords.longitude;
    
        status.textContent = latitude+" , "+longitude;
        console.log("lat: "+latitude+"; long: "+longitude)
    }
    
    function error() {
        status.textContent = 'Unable to retrieve your location';
    }

    if(!navigator.geolocation) {
        status.textContent = 'Geolocation is not supported by your browser';
    } else {
        status.textContent = 'Locating???';
        navigator.geolocation.getCurrentPosition(success, error, options);
    }

    setTimeout(get_location, 3000)
}

init()
animate()
