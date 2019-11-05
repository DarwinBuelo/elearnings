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
    var ctx = document.getElementById("progressGraph");
    ctx.height = 200;
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["1st", "2nd", "3rd", "4th"],
            datasets: [{
                    label: 'Scores',
                    data: [30, 44],
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

    jQuery(document).ready(function () {
        // just close the modal
        jQuery('#btnClose').click(function () {
            jQuery('#graph').fadeOut();
        });
        
        jQuery('[id=details]').click(function(){
            console.log(jQuery(this).data('id'));
            // ajax request the datails
            jQuery('#graph').fadeIn();
        });

    });
</script>