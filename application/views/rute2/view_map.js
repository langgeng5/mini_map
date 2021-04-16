var bg_canvas = document.querySelector('#background_layer');
var path_canvas = document.querySelector('#path_layer');
var point_canvas = document.querySelector('#point_layer');
var canvas = document.querySelector('#ui_layer');

var c_bg = bg_canvas.getContext('2d');
var c_path = path_canvas.getContext('2d');
var c_point = point_canvas.getContext('2d');
var ctx = canvas.getContext('2d');

// global
let canvas_width = 500;
let canvas_height = 500;
let circle_rad = 20;
let path_width = 30;
let path_color = 'grey';
var point_list = [];
var path_list = [];
let current_pos = {x: 0, y:0};
let destination = {x: 0, y:0};
let map_name = 'ini_nama';

let map_width = 20;
let map_height = 10;

let map_0 = {x: 115.196742,y: -8.637430}
const to_meter = 100000;

let action_status = '';

var background = new Image();
background.src = "<?= base_url('assets/maps/ini_nama.PNG') ?>";

canvas.addEventListener('mousemove', check_for_points);

background.onload = function(){
    canvas_width = background.width;
    canvas_height = background.height;
    
    
    init()
    c_bg.drawImage(background,0,0,canvas_width, canvas_height);  
    animate()
}

$(document).ready(function(){
    $.ajax({
        type:"POST",
        url:"<?= site_url('welcome/load_map') ?>",
        dataType: "json",
        data: {
            a: 'asd'
        },
        success: function (res) {
            var a = JSON.parse(res.point);
            var b = JSON.parse(res.path);
            
            $.each(a, function(index,val){
                point_list.push(new Point(val.x, val.y, val.r, val.color));
            })

            $.each(b, function(index,val){
                let xx = 0;
                let p = [];
                $.each(point_list, function(j){
                    if ((point_list[j].x == val.point1.x && point_list[j].y == val.point1.y) || (point_list[j].x == val.point2.x && point_list[j].y == val.point2.y)) {
                        p[xx] = point_list[j];
                        xx++;
                    }
                })
                path_list.push(new Path(p[0], p[1]));
            })
        }
    });

})

$('#find_now').click(function(){
    $.ajax({
        type:"POST",
        url:"<?= site_url('welcome/find_route') ?>",
        dataType: "json",
        data: {
            lokasi: current_pos,
            tujuan: destination,
            map_name: map_name
        },
        success: function (res) {
            console.log(res);
        }
    });
})


function getMousePos(event){
    var rect = canvas.getBoundingClientRect()

    return {
        x: event.clientX - rect.left,
        y: event.clientY - rect.top
    }
}
function distance(x1,y1,x2,y2){
    const xDist = x2-x1;
    const yDist = y2-y1;

    return Math.sqrt(Math.pow(xDist,2) + Math.pow(yDist, 2));
}


function Point(x,y,r,color){
    this.x = x;
    this.y = y;
    this.r = r;
    this.color = color;
    this.stroke_color = color;
    this.init_color = color;

    this.draw = function(){
        c_point.beginPath();
        c_point.arc(this.x,this.y,this.r,0, Math.PI*2, false);
        c_point.fillStyle = this.color;
        c_point.strokeStyle = this.stroke_color;
        c_point.fill();
        c_point.stroke();
    }
    // this.draw();
    this.hover = function(event){
        mousePos = getMousePos(event);

        if((distance(this.x, this.y, mousePos.x, mousePos.y) - this.r*2) < 0){
            this.stroke_color = 'black';
            // this.draw();
        }else{
            this.stroke_color = this.init_color;
            // this.draw();
        }
    }

    this.check = function(event){
        mousePos = getMousePos(event);

        if((distance(this.x, this.y, mousePos.x, mousePos.y) - this.r*2) < 0){
            return true
        }else{
            return false
        }
    }

    this.get_loc = function(){
        return {x: this.x, y: this.y}
    }

    this.move = function(event){
        mousePos = getMousePos(event);

        this.x = mousePos.x;
        this.y = mousePos.y;
    }

    this.update = function(){
        this.draw();
    }
    
}

function Path(point1, point2){
    this.point1 = point1;
    this.point2 = point2;

    this.draw = function(){
        c_path.beginPath();
        c_path.moveTo(this.point1.x,this.point1.y);
        c_path.lineWidth = path_width;
        c_path.lineCap = "round";
        c_path.strokeStyle = path_color;
        c_path.lineTo(this.point2.x,this.point2.y);
        c_path.stroke();
    }

    this.update = function(){
        this.draw();
    }

}

function init(){
    bg_canvas.width = canvas_width;
    bg_canvas.height = canvas_height;

    path_canvas.width = canvas_width;
    path_canvas.height = canvas_height;

    point_canvas.width = canvas_width;
    point_canvas.height = canvas_height;

    canvas.width = canvas_width;
    canvas.height = canvas_height;

    rectangle(ctx, 0, 0, canvas_width, canvas_height, 'black');
    get_location()
}
function animate(){
    requestAnimationFrame(animate);
    c_point.clearRect(0,0,canvas_width,canvas_height);
    c_path.clearRect(0,0,canvas_width,canvas_height);

    point_list.forEach(point => {
        point.update();
    });   

    path_list.forEach(path => {
        path.update();
    })
}

function check_for_points(event){
    point_hover = 0;

    for(var i = 0; i < point_list.length; i++){
        if(point_list[i].check(event)){
            point_hover = point_list[i];
            console.log(point_hover);
            break;
        }
    }  
}

function rectangle(c, x, y, dx, dy, color){
    c.strokeStyle = color;
    c.strokeRect(x, y, dx, dy);
}

function draw_circle(x,y){
    pos_0 = {
        x: Math.abs(map_0.x) * to_meter,
        y: Math.abs(map_0.y) * to_meter
    }
    let pos_now = {
        x: (Math.abs(x) * to_meter) - pos_0.x,
        y: (Math.abs(y) * to_meter) - pos_0.y
    }

    x_ini = Math.floor(canvas_width/map_width*pos_now.x);
    y_ini = Math.floor(canvas_height/map_height*pos_now.y);
    // console.log(canvas_width+' - '+canvas_height);
    // console.log(x_ini+' - '+y_ini);
    current_pos = {x: x_ini, y: y_ini};
    current_pos = {x: x_ini, y: y_ini};

    ctx.beginPath();
    ctx.arc(x_ini,y_ini,circle_rad,0, Math.PI*2, false);
    ctx.strokeStyle = 'red';
    ctx.fillStyle = 'blue';
    ctx.stroke();
    ctx.fill()
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
        // console.log("lat: "+latitude+"; long: "+longitude)
        ctx.clearRect(0,0,canvas_width,canvas_height);
        draw_circle(longitude,latitude);
    }
    
    function error() {
        status.textContent = 'Unable to retrieve your location';
    }

    if(!navigator.geolocation) {
        status.textContent = 'Geolocation is not supported by your browser';
    } else {
        status.textContent = 'Locating…';
        navigator.geolocation.getCurrentPosition(success, error, options);
    }

    setTimeout(get_location, 2000)
}