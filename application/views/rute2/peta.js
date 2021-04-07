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
var point_list = [];
var path_list = [];
let action_status = '';
let mouse_click = 0;
let path_width = 30;
let path_color = 'grey';

let point_hover = 0;
let point_selected = 0;

let start_point = 0;
let end_point = 0;

// canvas.addEventListener('click', make_point);
canvas.addEventListener('mousedown', start_click);
canvas.addEventListener('mouseup', end_click);
canvas.addEventListener('mousemove', hover_point);
canvas.addEventListener('mousemove', movepoint);
canvas.addEventListener('mousemove', check_for_points);

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

function clear_path_log(){
    start_point = 0;
    end_point = 0;
}

function removePath(value){
    let j = 0;
    while (j < path_list.length) {
        if(path_list[j].point1 == value || path_list[j].point2 == value){
            path_list.splice(j,1);
            j--;
        }
        j++;
    }
}
function removePoint(value) { 
    for (let i = 0; i < point_list.length; i++) {
        if(point_list[i] == value){
            point_list.splice(i,1);
            removePath(value);
            break;
        }
    }

    
}

function start_click(event){
    mouse_click = 1;
    point_selected = point_hover;
    
    if(action_status == 'create'){
        if(point_hover == 0){
            mousePos = getMousePos(event);
            start_point = make_point(event);
        }else{
            start_point = point_hover;
        }
    }else if(action_status == 'remove'){
        removePoint(point_hover);
    }
    
}

function end_click(event){

    mouse_click = 0;
    point_selected = 0;

    if(action_status == 'create'){
        if(point_hover == 0){
            mousePos = getMousePos(event);
            end_point = make_point(event);
        }else{
            end_point = point_hover;
        }

        if(start_point != 0 && end_point != 0){
            path_list.push(new Path(start_point, end_point));
        }
    }
    clear_path_log()
}

function movepoint(event){
    if(mouse_click == 1 && action_status=='move'){
        if (point_selected != 0) {
            point_selected.move(event);   
        }
    }
}

function check_for_points(event){
    point_hover = 0;

    for(var i = 0; i < point_list.length; i++){
        if(point_list[i].check(event)){
            point_hover = point_list[i];
            break;
        }
    }  
}

function hover_point(event){
    point_list.forEach(point => {
        point.hover(event);
    });   
}

function make_point(event){
    mousePos = getMousePos(event);
    var temp = new Point(mousePos.x,mousePos.y,circle_rad,'red')
    point_list.push(temp);

    return temp;
}

function make_path(event){
    mousePos = getMousePos(event);

    circle(c_point,mousePos.x,mousePos.y,circle_rad,'red');
}

function rectangle(c, x, y, dx, dy, color){
    c.strokeStyle = color;
    c.strokeRect(x, y, dx, dy);
}

function circle(c,x,y,r,color){
    c.beginPath();
    c.arc(x,y,r,0, Math.PI*2, false);
    c.fillStyle = color;
    c.fill();
}

function clear_canvas(){
    ctx.clearRect(0, 0, canvas_width, canvas_height);
    rectangle(ctx, 0, 0, canvas_width, canvas_height, 'black');
}

// background layers
var imageLoader = document.getElementById('imageLoader');
imageLoader.addEventListener('change', handleImage, false);

function handleImage(e){
    var reader = new FileReader();
    reader.onload = function(event){
        var img = new Image();
        img.onload = function(){
            canvas_width = img.width;
            canvas_height = img.height;

            init()
            c_bg.drawImage(img,0,0);
        }
        img.src = event.target.result;
    }
    reader.readAsDataURL(e.target.files[0]);     
}

init()
animate()