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
</div>
<hr>
<div class="row">
    <div class="col-md-2">
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

</script>
