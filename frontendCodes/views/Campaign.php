
<title>feedfront.ai | Campaign List</title>
<div class="wrapper wrapper-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Campaign</h5>
                        <div class="ibox-tools">
                            <a class="btn btn-sm btn-primary" id="AddCampaign">
                                <i class="fa fa-plus"></i> Add Campaign
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content" style="">
                        <form>
                            <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10 ">
                            <table class="table table-bordered" id="dtable">
                                <thead>
                                    <tr>
                                        <th>Campaign Name</th>
                                        <th>Start Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="dtbody">
                                    <?php
                                    foreach ($list as $li):
                                        ?>
                                    <tr >
                                        <td style="cursor: pointer;" onclick="window.location='Viewcampaign?Id=<?php echo $li['Id'] ?>'"><?php echo $li['Name'] ?></td>
                                        <td><?php echo $li['StartDate'] ?></td>
                                        <!--<td></td>-->
                                        <td><?php echo $li['Status'] ?></td>
                                    </tr>
                                    <?php
                                    endforeach;
                                    ?>
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
</div>

<div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close mclose"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Add Campaign</h4>
                <small class="font-bold"></small>
            </div>
            <form role="form" id="form">
                <div class="modal-body">
                    <div class="row ">
                        <div class="col-sm-6">
                            <div class="form-group"><label>Campaign Name*</label> 
                                <input type="text" name="campaignname" id="lname" placeholder="Enter Campaign Name" class="form-control">
                            </div>
                            <div class="form-group"><label>Customer List*</label> 
                                <select class="form-control" id="clist" name="list">
                                    <option value="">--Select--</option>
                                </select>
                            </div>
                            <div class="form-group"><label>Start Time*</label> 
                                <input name="stime" class="form-control" type="datetime-local">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group"><label>Automated Voice Message Content</label> 
                                <textarea rows="6" name="message" id="message" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <select id="attrib" class="form-control">

                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white mclose">Close</button>
                    <button type="submit" id="submit" class="btn btn-primary">Launch Campaign</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#attrib').html("<option value=''>--Select--</option>");
        $('#clist').html("<option value=''>--Select--</option>");
        $('#dtable').DataTable();
           
//         $("#myModal").keypress(function(event) {
//    if (event.keyCode == 13) {
//        event.preventDefault();
//        $("#form").submit();
//    }
//});
$("textarea").keyup(function(event){
            if (event.keyCode == 13) {
        event.preventDefault();
                        }
        if (this.value.match(/[^a-zA-Z0-9\[\] ]/g)) {
        this.value = this.value.replace(/[^a-zA-Z0-9\[\] ]/g, '');
        }
        });
        $("#form").validate({
            rules: {
                campaignname: {
                    required: true
                },
                list: {
                    required: true
                },
                stime: {
                    required: true
                },
                message: {
                    required: true
                }
            },
            submitHandler: function (form) {
                $.ajax({
                    type: 'post',
                    url: 'Addcampaign',
                    data: $('#form').serialize(),
                    dataType: 'JSON',
                    success: function (data) {
                        if(data<0){
                            var dt=-(data);
                            toastr.warning("Minutes Exhausted - Available minutes "+dt+" mins",
                            'Campaign could not be launched');
                        }else{
                          $('#myModal').modal('toggle');
                          $('#form').trigger("reset");
                          toastr.success("Campaign Added Successfully",'Message');
                          location.reload(); 
                        }
                      
                    }
                });
            }
        });
        $.ajax({
            type: "POST",
            url: "Getlist",
            dataType: 'JSON',
            success: function (data) {
                for (var i = 0; i < data.length; i++)
                {
                    $('#clist').append("<option value='" + (data[i]['Id']) + "'>" + (data[i]['Name']) + "</option>");
                }
            }
        });
        $('#AddCampaign').click(function () {
            $('#myModal').modal("show");
//            $('.sel-time-am').clockface();
        })
        $('#clist').change(function () {
            $('#attrib').html("<option value=''>--Select--</option>");
            $.ajax({
                type: 'POST',
                data: {
                    listId: $(this).val()
                },
                url: "Listdetails",
                dataType: 'JSON',
                success: function (data) {
                    for (var i = 0; i < data.length; i++)
                    {
                        $('#attrib').append("<option>" + (data[i]['Attributes_Name']) + "</option>");
                    }
                }
            })
        });
        $('#attrib').change(function () {
            var content = $('#message').val();
            $('#message').val(content + " [" + $(this).val() + "] ");
        });
      $('.mclose').click(function(){
          var data = $('#form').serializeArray();
            if(data[0].value != '' || data[1].value != '' || data[2].value != '' || data[3].value != '')
            {
            if(confirm("Are You sure....?"))
            {
                $('#myModal').modal('toggle');
                $('#form').trigger("reset");
            }
        }else{
            $('#myModal').modal('toggle');
            $('#form').trigger("reset");
        }
        });
    });
</script>