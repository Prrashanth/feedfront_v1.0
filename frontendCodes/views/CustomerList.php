<title>feedfront.ai | Customer List</title>
<div class="wrapper wrapper-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>List</h5>
                        <div class="ibox-tools">
                            <a class="btn btn-sm btn-primary" id="addModal">
                                <i class="fa fa-plus"></i> Add List
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content" style="">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8 ">
                            <table class="table table-bordered" id="dtable">
                                <thead>
                                    <tr>
                                        <th>List Name</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody id="dtbody">
                                    <?php
//                                    var_dump($list);
                                    foreach ($list as $li):
//                                        var_dump($li['Name']);
                                        ?>
                                    <tr>
                                        <td><?php echo $li['Name'] ?></td>
                                        <td><?php echo $li['Description'] ?></td>
                                    </tr>
                                    <?php
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                            </div>
                        </div>
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
                <button type="button" class="close mclose" ><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Add List</h4>
                <small class="font-bold"></small>
            </div>
            <form role="form" id="form">
             <div class="modal-body">
                    <div class="row ">
                        <div class="col-sm-6">
                            <div class="form-group"><label>List Name*</label> 
                                <input type="text" name="listname" id="lname"  placeholder="Enter List Name" class="form-control">
                                <label id="-error" class="error" for="">This field is required.</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group"><label>Description</label> 
                                <input type="text" name="description" placeholder="Enter Description" class="form-control">
                            </div>
                        </div>
                    </div>
                    <br>
                    <h3>Create Field Maps</h3>
                    <div class="row">
                        <div class="col-md-4">
                            <select class="form-control" id="ctype">
                            </select>
                        </div>
                        <div class="col-md-4" id="ccheck">
                            <div class="input-group"><input type="text" id="custom" class="form-control"> 
                                <span class="input-group-append"> 
                                    <button type="button" id="addtype" class="btn btn-primary">
                                        <i class="fa fa-plus"></i>
                                    </button> </span></div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-5">
                            <table class="table table-borderless">
                                <tbody id="tbody">

                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-7">
                            <button class="upload btn btn-primary" type="button" id="downloadxl" >Download Template</button>
                            <br><br><input type="file" id="fileup" class="upload btn btn-primary">
                        </div>
<!--                        <div class="col-sm-4">
                            <input type="file" class="upload btn btn-primary">
                        </div>-->
                    </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white mclose">Close</button>
                <button type="submit" id="submit" class="btn btn-primary">Save</button>
            </div>
                </form>
        </div>
    </div>
</div>



<script>
    var xlrows = [];
    var pattern =/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/;
    var timepat =/^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/;
    var mob = /^\d{10}$/;
    var failcount = 0;
    
    function resetDropdown()
    {
        $('#ctype').html("<option value=''>--Select--</option>");
//        ,'Preferred Date','Preferred Time'
        var dat = ['Customer Type','Product','Transaction Date','Custom'];
        var values = $("input[name='headers[]']").map(function(){return $(this).val();}).get();
        var data = dat.filter(function(val) {
            return values.indexOf(val) == -1;
        });
        for(var i=0;i<data.length;i++)
        {
            $('#ctype').append("<option>"+data[i]+"</option>");
        }
    }
    
    $(document).ready(function () {
        
        $("#myModal").keypress(function(event) {
    if (event.keyCode == 13) {
        event.preventDefault();
        $("#form").submit();
    }
});
        
        $('#dtable').DataTable();
//        $('#dtbody').html('');
        $('#-error').hide();
        $('#ccheck').hide();
//        $('.upload').hide();
$('#addModal').click(function(){
    $('#tbody').html('');
    var con = '<tr><td><input type="hidden" name="headers[]" value="Customer Name">Customer Name</td><td></td></tr>\n\
                <tr><td><input type="hidden" name="headers[]" value="Phone Number">Phone Number (Ex: +919876543210)</td><td></td></tr>';
                $('#tbody').append(con);
                resetDropdown();
    $('#myModal').modal('toggle')
})
        $('#ctype').change(function () {
            $('#ccheck').hide();
            if ($(this).val() == 'Custom')
            {
                $('#ccheck').show();
            }
        });
        $('#ctype').change(function () {
            if ($('#ctype').val() != '' && $('#ctype').val() != 'Custom' && $('#ctype').val() != 'Transaction Date')
            {
                var content = '<tr>\n\
                        <td><input type="hidden" name="headers[]" value="' + ($('#ctype').val() == 'Custom' ? $('#custom').val() : $('#ctype').val()) + '">\n\
                        ' + ($('#ctype').val() == 'Custom' ? $('#custom').val() : $('#ctype').val()) + '</td>\n\
                        <td><i class="del fa fa-times"  style="color:red"></i></td></tr>';
                $('#tbody').append(content);
                resetDropdown();
            }
            if ($('#ctype').val() == 'Transaction Date')
            {
                var content = '<tr>\n\
                        <td><input type="hidden" name="headers[]" value="Transaction Date">Transaction Date (dd/mm/yyyy)</td>\n\
                        <td><i class="del fa fa-times"  style="color:red"></i></td></tr>';
                $('#tbody').append(content);
                resetDropdown();
            }
        });
        $('#addtype').click(function () {
            if ($('#ctype').val() != '')
            {
                var content = '<tr>\n\
                        <td><input type="hidden" name="headers[]" value="' + ($('#ctype').val() == 'Custom' ? $('#custom').val() : $('#ctype').val()) + '">\n\
                        ' + ($('#ctype').val() == 'Custom' ? $('#custom').val() : $('#ctype').val()) + '</td>\n\
                        <td><i class="del fa fa-times"  style="color:red"></i></td></tr>';
                $('#tbody').append(content);
            }
            resetDropdown();
            $('#ccheck').hide();
        });
        
        
        $('#tbody').on('click', '.del', function () {
            
            $(this).closest('tr').remove();
            resetDropdown();
        });
        
        
        $('#downloadxl').click(function(){
            $('#-error').hide();
            if($('#lname').val() == '')
            {
                $('#-error').show();
                $('#lname').focus();
                return;
            }
            var headers = $("input[name='headers[]']").map(function () {
                return $(this).val();
            }).get();

        let ws = XLSX.utils.json_to_sheet([], {header: headers});
    let wb = XLSX.utils.book_new()
    XLSX.utils.book_append_sheet(wb, ws, $('#lname').val())
    let exportFileName = $('#lname').val()+"_det.xlsx";
    XLSX.writeFile(wb, exportFileName)

        });
        
        
        $('#fileup').change(function(e){
            var files = e.target.files;
        var i, f;
        window.failcount = 0;
        window.xlrows = [];
        for (i = 0, f = files[i]; i != files.length; ++i) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var data = e.target.result;
                var result;
                var workbook = XLSX.read(data, { type: 'binary', cellDates:true, cellNF:false, cellText:false});
                
                var sheet_name_list = workbook.SheetNames;
                sheet_name_list.forEach(function (y) { /* iterate through sheets */
                    //Convert the cell value to Json
                     result = XLSX.utils.sheet_to_json(workbook.Sheets[y],{dateNF:"YYYY-MM-DD"});
                     console.log(result);
                     for(var i=0;i<result.length;i++)
                     {
                        // console.log(result[i]);
                        // console.log(Object.keys(result[i]));
                        var err = true;
                        for(var j=0;j<Object.keys(result[i]).length;j++)
                        {
//                            if(Object.keys(result[i])[j].includes('Phone Number'))
//                            {
//                                result[i][Object.keys(result[i])[j]] = result[i][Object.keys(result[i])[j]].replace(/[^\d\+]/g,"");
//                                
//                                if(result[i][Object.keys(result[i])[j]].charAt(0) != "+")
//                                {
//                                    result[i][Object.keys(result[i])[j]] = "+"+result[i][Object.keys(result[i])[j]];
//                                }
//                                console.log(result[i][Object.keys(result[i])[j]]);
////                                if(!window.mob.test(result[i][Object.keys(result[i])[j]]))
////                                {
////                                    toastr.warning('Error in Phone Number '+result[i][Object.keys(result[i])[j]]+' on row '+(i+1),'Warning');
////                                    err = false;
////                                }
//                            }
                            if(Object.keys(result[i])[j].includes('Customer Name'))
                            {
                                if (result[i][Object.keys(result[i])[j]].match(/[^a-zA-Z]/g)) {
                                    result[i][Object.keys(result[i])[j]] = result[i][Object.keys(result[i])[j]].replace(/[^a-zA-Z]/g, '');
                                }
//                                console.log(result[i][Object.keys(result[i])[j]]);
//                                result[i][Object.keys(result[i])[j]] = formatDate(result[i][Object.keys(result[i])[j]]);
//                                if(!window.pattern.test(result[i][Object.keys(result[i])[j]]))
//                                {
//                                    console.log(formatDate(result[i][Object.keys(result[i])[j]]));
//                                    toastr.warning('Error in date format '+result[i][Object.keys(result[i])[j]]+' on row '+(i+1),'Warning');
//                                    err = false;
//                                }
                            }
                            if(Object.keys(result[i])[j].includes('Date') || Object.keys(result[i])[j].includes('date'))
                            {
                                result[i][Object.keys(result[i])[j]] = formatDate(result[i][Object.keys(result[i])[j]]);
                                if(!window.pattern.test(result[i][Object.keys(result[i])[j]]))
                                {
                                    console.log(formatDate(result[i][Object.keys(result[i])[j]]));
                                    toastr.warning('Error in date format '+result[i][Object.keys(result[i])[j]]+' on row '+(i+1),'Warning');
                                    err = false;
                                }
                            }
                            if(Object.keys(result[i])[j].includes('Time') || Object.keys(result[i])[j].includes('time'))
                            {
//                                console.log(result[i][Object.keys(result[i])[j]]);
                                result[i][Object.keys(result[i])[j]] = new Date((result[i][Object.keys(result[i])[j]]).getTime() + (9*60000)).toLocaleTimeString();
//                                console.log(result[i][Object.keys(result[i])[j]]);
//                                if(!window.timepat.test(result[i][Object.keys(result[i])[j]]))
//                                {
//                                    toastr.warning('Error in time format '+result[i][Object.keys(result[i])[j]]+' on row '+(i+1),'Warning');
//                                    err = false;
//                                }
                            }
                            if(err == false)
                            {
                                break;
                            }
                        }
                        if(err)
                        {
                            window.xlrows.push(result[i]);
                        }
                     }
                });
            };
            reader.readAsBinaryString(f);
        }
        });
        $('#form').on('submit',function(e){
        e.preventDefault();
        $('#-error').hide();
        if($('#lname').val() == '')
            {
                $('#-error').show();
                $('#lname').focus();
                return;
            }
            var data = $('#form').serializeArray();
            data.push({name: 'list', value: JSON.stringify(window.xlrows)});
            $.ajax({
            type: 'post',
            url: 'Addlist',
            data: data,
            success: function (data) {
                $('#myModal').modal('toggle');
                $('#form').trigger("reset");
               toastr.success("List Added Successfully",'Message');
               location.reload();
            }
          });
        });
        $('.mclose').click(function(){
            var data = $('#form').serializeArray();
//            console.log(data[0].value);
            if(data[0].value != '' || data[1].value != '')
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
    function formatDate(d)
 {
  date = new Date(d)
  var dd = date.getDate(); 
  var mm = date.getMonth()+1;
  var yyyy = date.getFullYear(); 
  if(dd<10){dd='0'+dd} 
  if(mm<10){mm='0'+mm};
  return d = mm+'/'+dd+'/'+yyyy
}
</script>