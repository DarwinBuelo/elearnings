<div class="custom_modal" id="graph">
    <div class="modalbox">
        <div class="modal-headers">
            <h4><span id="studentName">Test</span>'s Progress</h4>
        </div>
        <div class="modal-contents">
            <canvas id="progressGraph"></canvas>
        </div>
        <div class="modal-footers">
            <button class="btn btn-danger" id="btnClose"> Close</button>
        </div>
    </div>
</div>

<script>
    

    jQuery(document).ready(function () {
        // just close the modal
        jQuery('#btnClose').click(function () {
            jQuery('#graph').fadeOut();
        });
        
        jQuery('[id=details]').click(function(){
            jQuery.ajax({
                url: 'process.php',
                method: 'post',
                data : {
                   task : 'getDetailsExam',
                   examID: jQuery(this).data('id'),
                   studentID : <?= $sid?>
                },
                success: function(response){
                    $data = JSON.parse(response);
                    createGraph($data);
                },
                error : function(response){
                    console.log(response);
                }
            });
            jQuery('#graph').fadeIn();
        });

    });
    
    function createGraph(data){
    var ctx = document.getElementById("progressGraph");
    var lbl = [];
    var scores = [];
    count = 0;
    data.forEach(function(value){
        lbl.push(count += 1);
        scores.push(value.score);
    });
    
    ctx.height = 200;
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: lbl,
            datasets: [{
                    label: 'Scores',
                    data: scores,
                    backgroundColor: '#4267b2',
                    borderWidth: 1
                }]
        },
        options: {
            scales: {
                yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
            }
        }
    });
    }
</script>