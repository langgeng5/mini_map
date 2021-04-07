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
    <label>Image File:</label>
    <input type="file" id="imageLoader" name="imageLoader"/>
</div>
<hr>
<div style="float: left; margin-right: 30px;">
    <div class="btn"><button id="undo" class="">undo</button></div>
    <div class="btn"><button id="save" class="">save</button></div>
    <div class="btn"><button id="create" class="action_btn" onclick="select_btn(this)">create</button></div>
    <div class="btn"><button id="move" class="action_btn"  onclick="select_btn(this)">move</button></div>
    <div class="btn"><button id="remove" class="action_btn"  onclick="select_btn(this)">remove</button></div>
</div>
<div style="float: left">
    <div id="kanvas">
        <canvas id="background_layer"></canvas>
        <canvas id="path_layer"></canvas>
        <canvas id="point_layer"></canvas>
        <canvas id="ui_layer"></canvas>
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
