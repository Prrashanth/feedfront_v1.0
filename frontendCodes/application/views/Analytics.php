
<style>
   /* Absolute Center Spinner */
.loading {
  position: fixed;
  z-index: 999;
  height: 2em;
  width: 2em;
  overflow: show;
  margin: auto;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
}

/* Transparent Overlay */
.loading:before {
  content: '';
  display: block;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
    background: transparent;

  background: -webkit-radial-gradient(#2125291c, #2f405042);
}

/* :not(:required) hides these rules from IE9 and below */
.loading:not(:required) {
  /* hide "loading..." text */
  font: 0/0 a;
  color: transparent;
  text-shadow: none;
  background-color: transparent;
  border: 0;
}

.loading:not(:required):after {
  content: '';
  display: block;
  font-size: 10px;
  width: 1em;
  height: 1em;
  margin-top: -0.5em;
  -webkit-animation: spinner 150ms infinite linear;
  -moz-animation: spinner 150ms infinite linear;
  -ms-animation: spinner 150ms infinite linear;
  -o-animation: spinner 150ms infinite linear;
  animation: spinner 150ms infinite linear;
  border-radius: 0.5em;
  -webkit-box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
box-shadow: #1c84c6 1.5em 0 0 0, #1c84c6 1.1em 1.1em 0 0, #1c84c6 0 1.5em 0 0, #1c84c6 -1.1em 1.1em 0 0, 
    #1c84c6 -1.5em 0 0 0, #1c84c6 -1.1em -1.1em 0 0, #1c84c6 0 -1.5em 0 0,#1c84c6 1.1em -1.1em 0 0;
}

/* Animation */

@-webkit-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-moz-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-o-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
[class^=col] {
  display: flex;
  flex-direction: column;
}

[class^=col] div {
  flex-grow: 1
}
</style>
<title>feedfront.ai | KeyWord Mapping</title>
<div class="loading">Loading&#8230;</div>
<div class="wrapper wrapper-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div  class="ibox-title">
                        <h5>Analytics</h5>                            
                    </div>
                    <div class="ibox-content" style="">
                        <form role="form" id="form">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label>Select Type </label>
                                    <div class="radio">
                                                    <input type="radio" name="radio2" id="radio3" value="option1">
                                                    <label for="radio3">
                                                        Campaign
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <input type="radio" name="radio2" id="radio4" value="option2">
                                                    <label for="radio4">
                                                        Date Range
                                                    </label>
                                                </div>
                                </div>
                                <div class="col-sm-3 camp" >                           
                                    <div class="form-group"><label>Campaign List </label> 
                                        <select class="form-control" id="clist" name="Campaign">
                                            <option value="">--Select--</option>
                                            <?php
                                            foreach ($list as $li) {
                                                ?>
                                                <option value="<?php echo $li['Id'] ?>"><?php echo $li['Name'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>                                
                                </div>
                                <input type="hidden" name="database" value="<?php echo $this->db->database ?>">
                                <div class="col-sm-3 camp" >
                                    
                                </div>
                                <div class="col-sm-3 dates">
                                    <div class="form-group"><label>Start Date</label> 
                                        <input id="dt1" class="form-control" max="<?php echo date('Y-m-d') ?>" name="fromDate" type="date">   
                                    </div> 
                                </div>
                                <div class="col-sm-3 dates">
                                    <div class="form-group"><label>End Date</label> 
                                        <input id="dt2" class="form-control" max="<?php echo date('Y-m-d') ?>" name="toDate" type="date">
                                    </div>
                                </div>
                                <div class="col-sm-3 sub" style="padding-top: 30px">
                                    <button type="button" id="submit" class="btn btn-primary">Generate</button>
                                    <!--<button type="button" class="btn btn-white mclose">Close</button>-->

                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="alldata">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-content">
                        <?php // var_dump($vals); ?>
                        <div class="row">
                            <div class="col-md-3">
                                <h3>Number Of Contacts</h3>
                                <b style="padding-top: 10px;font-size: 15px" id="all"></b>
                            </div>
                            <div class="col-md-2">
                                <h3>Not Answered</h3>
                                <label  id="noa"></label>
                            </div>
                            <div class="col-md-2">
                                <h3>Reach </h3>
                                <label id="play"></label>
                            </div>
                            <div class="col-md-2">
                                <h3>Success </h3>
                                <label id="suc"></label>
                            </div>
                            <div class="col-md-2">
                                <h3>NPS Score</h3>
                                <label id="nps"></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6" >
                <div class="ibox " >
                    <div class="ibox-title">
                        <h5>NPS Report </h5>
                    </div>
                    <div class="ibox-content">
                        <div id="npsgraph"></div>
                    </div>
                </div>
            </div>
			 <div class="col-sm-6">
                <div class="ibox " >
                    <div class="ibox-title">
                        <h5>Overall Sentiment Score </h5>
                    </div>
                    <div class="ibox-content">
                        <div >
                            <div id="gauge"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Keyword Mapping</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="graph_container">
                            <div id="error1">
                                
                            </div>
                            <div  > <canvas id="barChart" ></canvas></div>
                            
                        </div>
                    </div>
                </div>
            </div>
           
            <div class="col-sm-6"></div>
           <div class="col-sm-6">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Feedback Categorization</h5>
                    </div>
                    <div class="ibox-content">
<!--                            <div id="error1">
                                
                            </div>-->
                                <div id="pie"></div>
                        </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Topic Mapping</h5>
                    </div>
                    <div class="ibox-content">
<!--                            <div id="error1">
                                
                            </div>-->
                                <div id="negetive"></div>
                        </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Feedback Categorization Of Payments</h5>
                    </div>
                    <div class="ibox-content">
<!--                            <div id="error1">
                                
                            </div>-->
                                <div id="pie1"></div>
                        </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Topic Mapping Of Payments</h5>
                    </div>
                    <div class="ibox-content">
<!--                            <div id="error1">
                                
                            </div>-->
                                <div id="negetive1"></div>
                        </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Feedback Categorization Of Convenience</h5>
                    </div>
                    <div class="ibox-content">
<!--                            <div id="error1">
                                
                            </div>-->
                                <div id="pie2"></div>
                        </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Topic Mapping Of Convenience</h5>
                    </div>
                    <div class="ibox-content">
<!--                            <div id="error1">
                                
                            </div>-->
                                <div id="negetive2"></div>
                        </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Feedback Categorization Of Customer Experience</h5>
                    </div>
                    <div class="ibox-content">
<!--                            <div id="error1">
                                
                            </div>-->
                                <div id="pie3"></div>
                        </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Topic Mapping Of Customer Experience</h5>
                    </div>
                    <div class="ibox-content">
<!--                            <div id="error1">
                                
                            </div>-->
                                <div id="negetive3"></div>
                        </div>
                </div>
            </div>
        </div>
<!--         <div class="col-lg-6">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Net Promoter Score</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="graph_container">
                            <div id="error1">
                                
                            </div>
                            <div id="triangleMarker"></div>
                        </div>
                    </div>
                </div>
            </div>-->
    </div>
    <script>
        $('#alldata').hide();
        $(".loading").hide();
        $(document).ready(function () {
            $('#dt1').change(function(){
                $('#dt2').attr("min",$(this).val());
            })
            $('.camp').hide();
            $('.dates').hide();
            $('.sub').hide();
            $('input[type=radio]').click(function(){
                $('#clist').val('');
                $('#dt1').val('');
                $('#dt2').val('');
                $('#dt2').removeAttr('min');
                $('.sub').show();
                if($(this).val() == 'option1')
                {
                    $('.camp').show();
                    $('.dates').hide();
                }else{
                    $('.camp').hide();
                    $('.dates').show();
                }
            });
            var myChart;
            $('#submit').click(function () {
				if($('#dt2').val() == '')
                {
                    $('#dt2').val($('#dt1').val());
                }
                $('#alldata').hide();
                $('#error1').html('');
                $(".loading").show();
                $.ajax({
                    type: 'POST',
                    dataType: 'JSON',
                    data: $('#form').serialize(),
//                    url: 'http://35.226.185.230:8112/',
                    url: 'Getanlytics',
                    success: function (data) {
                        $('#alldata').show();
                        $(".loading").hide();
                        console.log(data['pdata']);
                        $('#all').html(data['vals'].allcount);
                        $('#suc').html(data['vals'].reached);
                        $('#play').html(data['vals'].played);
                        $('#noa').html(data['vals'].noanswer);
                        $('#nps').html(data['vals'].nps);
//   --------------------------------Sentiment score---------------------------
                        c3.generate({
                            bindto: '#gauge',
                            data: {
                                columns: [
                                    ['Score', data['sentiment']]
                                ],
                                type: 'gauge'
                            },
                            color: {
                                pattern: ['#1ab394', '#BABABA']

                            }
                        });
    
// --------------------------------------NPS GrAPh --------------------------------
var clickhandler = function(event) {
    window.location="NPSReport?"+$('#form').serialize();
}
 c3.generate({
     bindto: '#npsgraph',
    data: {
        columns: [
          ['NPS', data['vals'].npss]
        ],
        type: 'gauge',
        onclick: function (event) { 
            clickhandler(event)
        }
      },
      gauge: {
        label: {
          format: function(value, ratio) {
              return value + '%';
          },
          show: true
        },
        min: -100,
        max: 100,
        //units: '%',
      },
      color: {
        pattern: ['#FF0000','#F6C600','#60B044', ], // the three color levels for the percentage values.
        threshold: {
            values:[-100,0,100]
        }
      },
      size: {
        height: 160
      }
});
 
//  ---------------------------------Keyword Mapping ------------------------\
                        if(data['keyword'][1].length > 0)
                        {
                            var labels = data['keyword'][0];
                            var data1 = data['keyword'][1].map(function (num) {
                            return Math.round(num);
                            });
                            var data2 = data1.map(function (num) {
                            return 100 - num;
                            });
                            var barOptions =
                            {
                                    tooltips: {
                                        enabled: false
                                    },
                                    hover: {
                                        animationDuration: 0
                                    },
                                    scales: {
                                        xAxes: [{
                                                ticks: {
                                                    beginAtZero: true,
                                                    fontFamily: "'Open Sans Bold', sans-serif",
                                                    fontSize: 11
                                                },
                                                scaleLabel: {
                                                    display: false
                                                },
                                                gridLines: {
                                                },
                                                stacked: true
                                            }],
                                        yAxes: [{
                                                gridLines: {
                                                    display: false,
                                                    color: "#fff",
                                                    zeroLineColor: "#fff",
                                                    zeroLineWidth: 0
                                                },
                                                ticks: {
                                                    fontFamily: "'Open Sans Bold', sans-serif",
                                                    fontSize: 11,
                                                    width:'150px',
                                                },
                                                stacked: true
                                            }]
                                    },
                                    legend: {
                                        display: false
                                    },
                                    animation: {
                                        onComplete: function () {
                                            var chartInstance = this.chart;
                                            var ctx = chartInstance.ctx;
                                            ctx.textAlign = "left";
                                            ctx.font = "9px Open Sans";
                                            ctx.fillStyle = "#fff";

                                            Chart.helpers.each(this.data.datasets.forEach(function (dataset, i) {
                                                var meta = chartInstance.controller.getDatasetMeta(i);
                                                Chart.helpers.each(meta.data.forEach(function (bar, index) {
                                                    data = dataset.data[index];
                                                    if (i == 0) {
                                                        ctx.fillText(data+' %', 90, bar._model.y + 4);
                                                    } else {
                                                        ctx.fillText(data+' %', bar._model.x - 25, bar._model.y + 4);
                                                    }
                                                }), this)
                                            }), this);
                                        }
                                    },
                                    pointLabelFontFamily: "Quadon Extra Bold",
                                    scaleFontFamily: "Quadon Extra Bold",
                        };

                        var barData = {
                            labels: labels,
                            datasets: [{
                                    data: data1,
                                    backgroundColor: "#1ab394",
                                    hoverBackgroundColor: "rgba(50,90,100,1)"
                                }, {
                                    data: data2,
                                    backgroundColor: "rgba(163,103,126,1)",
                                    hoverBackgroundColor: "rgba(140,85,100,1)"
                                }]
                        };

                        if (myChart) {
                                myChart.data.labels = barData.labels;
                                myChart.data.datasets[0].data = barData.datasets[0].data;
                                myChart.data.datasets[1].data = barData.datasets[1].data;
                                myChart.update();
                        }else{
                               var ctx2 = document.getElementById("barChart").getContext("2d");
                               myChart = new Chart(ctx2, {type: 'horizontalBar', data: barData, options: barOptions});
                        }

                        }
                        else{
                            if (myChart) {
                                myChart.destroy();
                            }
                            $('#error1').html('<h3>No Data Available</h3>')
                        }

                        var colors= ['#1f77b4', '#aec7e8', '#ff7f0e', '#ffbb78', '#2ca02c', '#98df8a', '#d62728', '#ff9896', '#9467bd', '#c5b0d5', '#8c564b', '#c49c94', '#e377c2', '#f7b6d2', '#7f7f7f', '#c7c7c7', '#bcbd22', '#dbdb8d', '#17becf', '#9edae5'];
                        c3.generate({
                                    bindto: '#pie',
                                    data:{
                                        columns: data['categorization'],
                                        type : 'pie',
                                    },
                                    color:{
                                             pattern: colors
                                        }
                        });
                        c3.generate({
                                    bindto: '#pie1',
                                    data:{
                                        columns: data['PaymentsKey'],
                                        type : 'pie',
                                    },
                                    color:{
                                             pattern: colors
                                        }
                        });
                        c3.generate({
                                    bindto: '#pie2',
                                    data:{
                                        columns: data['ConvenienceKey'],
                                        type : 'pie',
                                    },
                                    color:{
                                             pattern: colors
                                        }
                        });
                        c3.generate({
                                    bindto: '#pie3',
                                    data:{
                                        columns: data['Customer ExperienceKey'],
                                        type : 'pie',
                                    },
                                    color:{
                                             pattern: colors
                                        }
                        });

                      //  var ydata = ['Service','Cleaniness','Ambience','Pricing','Quality']
                        var ydata = data['SenCat']['catarr'];



                        c3.generate({
                            bindto: '#negetive',
                            data:{
                                columns: [
                                   // ['data1', 30, 200, 100, 400, 150],
                                    //['data2', -130, -100, -140, -200, -150]
                                    data['SenCat']['positivearr'],
                                    data['SenCat']['negarr']
                                ],
                                colors:{
                                    positive: '#1ab394',
                                    negative: '#BABABA'
                                },
                                type : 'bar',
                               // groups : [['data1','data2']]
                                groups : [['positive','negative']]
                            },
                            axis: { x: {
                            type: 'category',
                            categories: ydata,
                            }}
                        });
                        var ydata1 = data['PaymentsSubCat']['catarr'];
                        var ydata2 = data['ConvenienceSubCat']['catarr'];
                        var ydata3 = data['Customer ExperienceSubCat']['catarr'];
                        c3.generate({
                            bindto: '#negetive1',
                            data:{
                                columns: [
                                   // ['data1', 30, 200, 100, 400, 150],
                                    //['data2', -130, -100, -140, -200, -150]
                                    data['PaymentsSubCat']['positivearr'],
                                    data['PaymentsSubCat']['negarr']
                                ],
                                colors:{
                                    positive: '#1ab394',
                                    negative: '#BABABA'
                                },
                                type : 'bar',
                               // groups : [['data1','data2']]
                                groups : [['positive','negative']]
                            },
                            axis: { x: {
                            type: 'category',
                            categories: ydata1,
                            }}
                        });
                        c3.generate({
                            bindto: '#negetive2',
                            data:{
                                columns: [
                                   // ['data1', 30, 200, 100, 400, 150],
                                    //['data2', -130, -100, -140, -200, -150]
                                    data['ConvenienceSubCat']['positivearr'],
                                    data['ConvenienceSubCat']['negarr']
                                ],
                                colors:{
                                    positive: '#1ab394',
                                    negative: '#BABABA'
                                },
                                type : 'bar',
                               // groups : [['data1','data2']]
                                groups : [['positive','negative']]
                            },
                            axis: { x: {
                            type: 'category',
                            categories: ydata2,
                            }}
                        });
                        c3.generate({
                            bindto: '#negetive3',
                            data:{
                                columns: [
                                   // ['data1', 30, 200, 100, 400, 150],
                                    //['data2', -130, -100, -140, -200, -150]
                                    data['Customer ExperienceSubCat']['positivearr'],
                                    data['Customer ExperienceSubCat']['negarr']
                                ],
                                colors:{
                                    positive: '#1ab394',
                                    negative: '#BABABA'
                                },
                                type : 'bar',
                               // groups : [['data1','data2']]
                                groups : [['positive','negative']]
                            },
                            axis: { x: {
                            type: 'category',
                            categories: ydata3,
                            }}
                        });
                                }
                            });
                        });
            
            
        });

// var options = {
//        geometry: {
//            startAngle: 360, 
//    		endAngle: 0
//        },
//        scale: {
//            startValue: -100, 
//    		endValue: 100,
//    		tickInterval: 10
//        }
//    };
// $("#triangleMarker").dxCircularGauge($.extend(true, {}, options, {
//        value: -40,
//        subvalues: [20, 80],
//        subvalueIndicator: {
//            type: "triangleMarker",
//            color: "#8FBC8F"
//        }
//    }));
    </script>
