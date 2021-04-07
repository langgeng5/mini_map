var canvas = document.querySelector('#peta');

canvas.width = <?= $image_width ?>;
canvas.height = <?= $image_height ?>;

var c = canvas.getContext('2d');

c.strokeRect(0, 0, canvas.width, canvas.height);

var background = new Image();
background.src = "<?= base_url('assets/maps/'.$image_data) ?>";

const x = <?= $grid_x ?>;
const y = <?= $grid_y ?>;
const path_color = 'rgba(199, 199, 199)'
const point_color = 'red'
const hover_color = 'rgba(238, 255, 0, 0.5)'

let dist = canvas.height / x;

let pos = <?= $map_data ?>;

function circle(x,y,r,color){
    c.beginPath();
    c.arc(x,y,r,0, Math.PI*2, false);
    c.fillStyle = color;
    c.fill();
}

function center_box(x,y){
    res = {
        x: x+(dist/2),
        y: y+(dist/2),
    }
    return res
}

function create_path(posisi){
    let parent = pos[posisi.x][posisi.y]
    let center_parent = center_box(parent.x, parent.y)
    let koor = []

    let x_s_rad = []
    if(posisi.x == 0){
        x_s_rad.push(posisi.x + 1)
    }
    else if(posisi.x == x-1){
        x_s_rad.push(posisi.x-1)
    }
    else{
        x_s_rad.push(posisi.x-1)
        x_s_rad.push(posisi.x + 1)
    }
    for(let n=0; n<x_s_rad.length; n++){
        koor.push({x:x_s_rad[n], y:posisi.y})
    }

    let y_s_rad = []
    if(posisi.y == 0){
        y_s_rad.push(posisi.y + 1)
    }else if(posisi.y == y-1){
        y_s_rad.push(posisi.y-1)
    }else{
        y_s_rad.push(posisi.y-1)
        y_s_rad.push(posisi.y + 1)
    }
    for(let n=0; n<y_s_rad.length; n++){
        koor.push({x:posisi.x, y:y_s_rad[n]})
    }
    // console.log(koor);

    
    for(let m = 0; m<koor.length; m++){
        let i = koor[m].x
        let j = koor[m].y
        if((pos[i][j].is_point == 1 || pos[i][j].is_path == 1) && pos[i][j].is_selected == 0){
            pos[i][j].is_selected = 1

            if(parent.is_selected == 1){
                c.beginPath();
                c.moveTo(center_parent.x, center_parent.y);
            }
            parent.is_selected = 1
            let center_loc = center_box(pos[i][j].x,pos[i][j].y)

            c.lineWidth = 30
            c.lineCap = "round"
            c.strokeStyle = 'rgba(255,255,255,0.7)'

            c.lineTo(center_loc.x, center_loc.y)
            c.stroke()
            c.beginPath()
            c.lineTo(center_loc.x, center_loc.y)
            create_path({x:i, y:j})
        }
    }
    
    return 0
}

function find_first_path(){
    for(let i=0; i<x; i++){
        for(let j=0; j<y; j++){
            if((pos[i][j].is_point == 1 || pos[i][j].is_path == 1) && pos[i][j].is_selected == 0){
                let center_loc = center_box(pos[i][j].x,pos[i][j].y)
                c.beginPath();
                c.moveTo(center_loc.x, center_loc.y);
                return {x: i, y: j}
            }
        }
    }
}


function init(){

    create_path(find_first_path());
    
    for(let i=0; i<x; i++){
        for(let j=0; j<y; j++){
            if(pos[i][j].is_point == 1){
                ini = center_box(pos[i][j].x, pos[i][j].y)

                circle(ini.x,ini.y ,dist/2 ,pos[i][j].color)

                c.font = "12px Arial"
                c.fillStyle = "white"
                c.fillText(pos[i][j].label, pos[i][j].x + 5, ini.y + 4)
            }
        }
    }


}

background.onload = function(){
    c.drawImage(background,0,0,canvas.width, canvas.height);  
    
    init()
}
