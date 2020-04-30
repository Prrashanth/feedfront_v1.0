<style>
    .graph_container{
        /*display:block;*/
        /*width:600px;*/
    }
</style>
<title>feedfront.ai | KeyWord Mapping</title>
<div class="wrapper wrapper-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div  class="ibox-title">
                        <h5><?php echo $list['Name'] ?> Details</h5>                            
                    </div>
                    
                    <div class="ibox-content">
                        <?php // var_dump($vals); ?>
                        <div class="row">
                            <div class="col-md-3">
                                <h3>Customer List</h3>
                                <h4 class="no-margins text-navy"><?php echo $list['list'] ?></h4>
                            </div>
                            
                            <div class="col-md-3">
                                <h3>Reach Rate</h3>
                                <h4 class="no-margins text-navy"><?php echo $vals['reached'] ?>%</h4>
                            </div>
                            <div class="col-md-3">
                                <h3>Message Played</h3>
                                <h4 class="no-margins text-navy"><?php echo $vals['played'] ?>%</h4>
                            </div>
                            <div class="col-md-3">
                                <h3>Not Answered</h3>
                                <h4 class="no-margins text-navy"><?php echo $vals['noanswer'] ?>%</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ibox">
                    
                    <div class="ibox-content" style="">
                        <form role="form" id="form">
                            <div class="row">
                                <div class="col-sm-12">
                                    <strong>Automated Message Content :</strong>
                                    <?php echo $list['Message'] ?>
                                </div>
                                <div class="col-sm-12">
                                    <br>
                                    <table class="table" id="dtable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Customer Name</th>
                                                <th>Phone Number</th>
                                                <th>Status</th>
                                                <th>Sentiment Score</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    table = $('#dtable').DataTable({
        "processing": true, 
        "serverSide": true,
        "order": [], 
        "ajax": {
            "url": "CampaignDetails",
            "type": "POST",
            "data" :{
                'campId':'<?php echo $_GET['Id'] ?>'
            }
        },
        "columnDefs": [
        { 
            "targets": [ 0 ], 
            "orderable": false,
        },
        ],
 
    });
	function playAudio(RecId,MobNumber)
{
    swal({
                title: MobNumber+" Recording",
                text: '<audio controls="controls" autoplay preload="auto"><source src="http://35.226.185.230:8200/'+RecId+'.wav" type="audio/wav">Your browser does not support the audio element.</audio>',
                html: true,
                closeOnConfirm: false
            },function () {
                 $('audio').trigger("pause");
                 swal.close();
//        swal("Deleted!", "Your imaginary file has been deleted.", "success");
    });
}
    </script>