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

        jQuery('[id=details]').click(function () {
            reset();
            jQuery.ajax({
                url: 'process.php',
                method: 'post',
                data: {
                    task: 'getDetailsExam',
                    examID: jQuery(this).data('id'),
                    studentID: <?= $sid ?>
                },
                success: function (response) {
                    var data = JSON.parse(response);
                    if (data.length > 0) {
                        createGraph(data);
                        jQuery('#graph').fadeIn();
                    } else {
                        alert('No Exam yet');
                    }
                },
                error: function (response) {
                    console.log(response);
                }
            });
        });

    });

    var lbl = [0];
    var scores = [0];
    count = 0;
    function reset() {
        lbl = [];
        scores = [];
        count = 0;
    }

    function createGraph(data) {
        reset();
        var ctx = document.getElementById("progressGraph");
        count = 0;
        
        data.forEach(function (value) {
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