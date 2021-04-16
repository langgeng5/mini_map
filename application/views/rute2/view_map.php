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
        <button id = "find-me">Show my location</button><br/>
        <p id = "status"></p>
        <a id = "map-link" target="_blank"></a>
        <br>
        <button class="btn btn-success" id="find_now">cari tujuan</button>
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
