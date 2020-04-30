<title>feedfront.ai | KeyWord Mapping</title>
<div class="wrapper wrapper-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div  class="ibox-title">
                        <h5>NPS Details</h5>                            
                    </div>
                    
                    <div class="ibox-content">
                        <?php // var_dump($vals); ?>
                        <div class="row">
                            <div class="col-md-3">
                                <h3>Number Of Contacts</h3>
                                <b style="padding-top: 10px;font-size: 15px"><?php echo $vals['allcount'] ?> Contacts</b>
                            </div>
                            
                            
                            <div class="col-md-2">
                                <h3>Not Answered</h3>
                                <h4 class="no-margins text-navy"><?php echo $vals['noanswer'] ?></h4>
                            </div>
                            <div class="col-md-2">
                                <h3>Reach </h3>
                                <h4 class="no-margins text-navy"><?php echo $vals['played'] ?></h4>
                            </div>
                            <div class="col-md-2">
                                <h3>Success </h3>
                                <h4 class="no-margins text-navy"><?php echo $vals['reached'] ?></h4>
                            </div>
                            <div class="col-md-2">
                                <h3>NPS Score</h3>
                                <?php echo $vals['nps'] ?>
                            </div>
                        </div>
                    </div>
                </div>
                        <form role="form" id="form">
                            <div class="row">
                                <div class="col-sm-12 table-responsive">
                                    <div class="tabs-container">
                        <ul class="nav nav-tabs" role="tablist">
                            <li><a class="nav-link active show" data-toggle="tab" href="#tab-1"> Promoters</a></li>
                            <li><a class="nav-link" data-toggle="tab" href="#tab-2">Detractors</a></li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" id="tab-1" class="tab-pane active show">
                                <div class="panel-body">
                                     <table class="table" id="dtable">
                                        <thead>
                                            <tr>
                                                <th>Customer Name</th>
                                                <th>Phone Number</th>
                                                <th>Status</th>
                                                <th>Sentiment Score</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            foreach ($records as $rec){
                                                if($rec['Category_Name'] == 'NPS_Positive')
                                                {
                                                ?>
                                            <tr>
                                                <td><?php echo $rec['Customer_Name'] ?></td>
                                                <td><?php echo $rec['Mobile_Number'] ?></td>
                                                <td><button class="btn btn-sm btn-success" onclick="playAudio('<?php echo $rec['Feedback_Url'] ?>','<?php echo $rec['Mobile_Number'] ?>')" type="button"><i class="fa fa-play"></i>&nbsp;&nbsp;<span class="bold">Play Audio</span></button></td>
                                                <td><?php echo $rec['Sentement_score'] ?></td>
                                            </tr>
                                            <?php
                                                }
                                            } 
                                            ?>
                                        </tbody>
                                    </table>
                                    </div>
                            </div>
                            <div role="tabpanel" id="tab-2" class="tab-pane">
                                <div class="panel-body">
                                    <table class="table" id="dtable">
                                        <thead>
                                            <tr>
                                                <th>Customer Name</th>
                                                <th>Phone Number</th>
                                                <th>Status</th>
                                                <th>Sentiment Score</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            foreach ($records as $rec){
                                                if($rec['Category_Name'] == 'NPS_Negative')
                                                {
                                                ?>
                                            <tr>
                                                <td><?php echo $rec['Customer_Name'] ?></td>
                                                <td><?php echo $rec['Mobile_Number'] ?></td>
                                                <td><button class="btn btn-sm btn-success" onclick="playAudio('<?php echo $rec['Feedback_Url'] ?>','<?php echo $rec['Mobile_Number'] ?>')" type="button"><i class="fa fa-play"></i>&nbsp;&nbsp;<span class="bold">Play Audio</span></button></td>
                                                <td><?php echo $rec['Sentement_score'] ?></td>
                                            </tr>
                                            <?php
                                            
                                                }
                                            } 
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                    </div>
                                   
                                </div>
                            </div>
                        </form>
                    
            </div>
        </div>
    </div>
    <script>
    table = $('.table').DataTable();
    
function playAudio(RecId,MobNumber)
{
    swal({
                title: MobNumber+" Recording",
                text: '<audio controls="controls" autoplay preload="auto"><source src="http://ec2-18-218-39-169.us-east-2.compute.amazonaws.com:8080/'+RecId+'.wav" type="audio/wav">Your browser does not support the audio element.</audio>',
                html: true,
                closeOnConfirm: false
            },function () {
                 $('audio').trigger("pause");
                 swal.close();
//        swal("Deleted!", "Your imaginary file has been deleted.", "success");
    });
}
    </script>