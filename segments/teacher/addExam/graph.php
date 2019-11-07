<div class="custom_modal" id="graph">
    <div class="modalbox">
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

        jQuery('#analytics').click(function () {
            jQuery('#graph').fadeIn();
        });

    });


    var ctx = document.getElementById("progressGraph");
    ctx.height = 200;
    var labels = <?= json_encode($examTitle) ?>;
    var pass =[];
    var fail = [];
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: "Pass",
                    backgroundColor: "#3e95cd",
                    data: <?= json_encode($pass) ?>
                }, {
                    label: "Fail",
                    backgroundColor: "#ca3e4c",
                    data: <?= json_encode($fail) ?>
                }
            ]
        },
        options: {
            title: {
                display: true,
                text: 'Course Exams'
            },
            scales: {
                    yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                }
        }
    });


</script>