var canvas = document.querySelector('#map_canvas');
var undo = document.querySelector('#undo')
var point = document.querySelector('#point')
var path = document.querySelector('#path')
var action = document.querySelector('.action')
var save = document.querySelector('#save')
var load = document.querySelector('#load')



canvas.width = 500;
canvas.height = 1000;

var c = canvas.getContext('2d');


c.strokeRect(0, 0, canvas.width, canvas.height);



var background = new Image();
background.src = "contoh.png";

const x = 20;
const y = 10;
const path_color = 'rgba(199, 199, 199)'
const point_color = 'red'
const hover_color = 'rgba(238, 255, 0, 0.5)'

let dist = canvas.height / x;

let pos = [];
let canvas_history = []
let grid_color = 'black'
let mouse_color = hover_color

let mouse_click = 0;

function start_click(event){
    mouse_click = 1;
    update_grid(event)
}

function end_click(event){
    mouse_click = 0;
    if(mouse_color != hover_color){
        canvas_history.push(c.getImageData(0,0,canvas.width,canvas.height))
    }
}

function do_undo(event){
    if(canvas_history.length > 1){
        canvas_history.pop()
        c.putImageData(canvas_history[canvas_history.length - 1],0,0);
    }
}

function be_initial(grid){
    grid.is_path = 0
    grid.is_point = 0
    grid.label = ''
    grid.is_selected =0
    grid.point_before = {x: '', y: ''}

    return 0
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
};


function Grid(x,y,dist, color = 'rgba(0,0,0,0)'){
    this.x = y*dist
    this.y = x*dist
    this.dist = dist
    this.color = color
    this.initial_color = color
    this.is_path = 0
    this.is_point = 0
    this.label = ''
    this.is_selected =0
    this.point_before = {x: '', y: ''}

    this.getPos = () =>{
        pos = {
            x: this.x,
            y: this.y
        }
        return pos
    }

    this.update = function(event){
        this.draw();
    };

    this.draw = () => {
        c.fillStyle = this.color;
        c.fillRect(this.x, this.y, dist,dist);

        c.strokeStyle = grid_color
        c.strokeRect(this.x, this.y, dist,dist);
    };

}

function empty_hover(){
    c.putImageData(canvas_history[canvas_history.length - 1],0,0);
}

function update_grid(event){
    mousePos = getMousePos(event)

    let px = Math.floor(mousePos.x/dist)
    let py = Math.floor(mousePos.y/dist)

    if(mouse_color == hover_color){
        empty_hover()
    }
    
    if(pos[py][px].color != mouse_color){
        if(mouse_click === 1){
            pos[py][px].color = mouse_color;
            if(mouse_color == path_color){
                pos[py][px].is_path = 1
            }else if(mouse_color == point){
                pos[py][px].is_point = 1
            }
        }else{
            empty_hover()
            pos[py][px].color = hover_color;
        }
    }
    pos[py][px].draw();

    
}


function init(){
    for(let i = 0; i < x; i++){
        temp = []
        for(let j = 0; j < y; j++){
            temp.push(new Grid(i,j,dist));
        }
        pos.push(temp);
    }

    for(let i = 0; i < x; i++){
        for(let j = 0; j < y; j++){
            pos[i][j].draw()
        }
    }

}

function reset_style(){
    var all = document.getElementsByClassName('action');
    for (var i = 0; i < all.length; i++) {
        all[i].style.color = 'black';
    }
    console.log(action.length);
}

function point_ready(event){
    reset_style()
    point.style.color = 'red';

    mouse_color = point_color
}
function path_ready(event){
    reset_style()
    path.style.color = 'red';

    mouse_color = path_color
}

function save_data(){
    var data = JSON.stringify(pos)
    var blob = new Blob([data], { type: "application/json"})
    var a = document.createElement("a");
    a.download = "asem.json"
    a.href = URL.createObjectURL(blob);
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
}

function load_data(){
    const hehe = require('asem.json');
    console.log(hehe);
}

background.onload = function(){
    c.drawImage(background,0,0,canvas.width, canvas.height);  
    
    init()
    canvas_history.push(c.getImageData(0,0,canvas.width,canvas.height))
    
    canvas.addEventListener('mousedown', start_click)
    canvas.addEventListener('mouseup', end_click)
    canvas.addEventListener('mousemove', update_grid)

    undo.addEventListener('click', do_undo)
    point.addEventListener('click', point_ready)
    path.addEventListener('click', path_ready)
    save.addEventListener('click', save_data)
    load.addEventListener('click', load_data)
}


