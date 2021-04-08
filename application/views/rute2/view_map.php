<style>
    canvas { position: absolute; }
    #ui_layer { z-index: 4; }
    #point_layer { z-index: 3; }
    #path_layer { z-index: 2; }
    #background_layer { z-index: 1; }

    .btn{
        margin-bottom: 10px;
    }
</style>
<div>
    <form action="" id="bg_image" enctype="multipart/form-data">
        <label>Image File:</label>
        <input type="file" id="imageLoader" name="imageLoader" />
    </form>
</div>
<hr>
<div class="row">
    <div class="col-md-2">
    <ul class="list-group">
        <li class="list-group-item"><button id="undo" class="btn btn-primary">undo</button></li>
        <li class="list-group-item"><button id="save" class="btn btn-primary">save</button></li>
        <li class="list-group-item"><button id="create" class="action_btn btn btn-primary" onclick="select_btn(this)">create</button></li>
        <li class="list-group-item"><button id="move" class="action_btn btn btn-primary"  onclick="select_btn(this)">move</button></li>
        <li class="list-group-item"><button id="remove" class="action_btn btn btn-primary"  onclick="select_btn(this)">remove</button></li>
    </ul>
        
        
        
        
    </div>
    <div class="col-md-4">
        <div id="kanvas">
            <canvas id="background_layer"></canvas>
            <canvas id="path_layer"></canvas>
            <canvas id="point_layer"></canvas>
            <canvas id="ui_layer"></canvas>
        </div>
    </div>
</div>
<script>

function reset_btn(){
    var all = document.getElementsByClassName('action_btn');
    for (var i = 0; i < all.length; i++) {
        all[i].style.color = 'black';
    }
}
function select_btn(a){
    reset_btn();
    action_status = a.getAttribute('id');
    // console.log(action_status);
    a.style.color = 'red';
}

</script>
