<?php

defined('BASEPATH') OR exit('No direct script access allowed');

?>

            <div class="content-wrapper">
                <section class="content-header">
                    <?php echo $pagetitle; ?>
                    <?php echo $breadcrumb; ?>
                </section>

                <section class="content">
                    <div class="row">

                        <div class="col-md-3">
                
                            <div class="box box-warning box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title">New Salary</h3>

                                    <div class="box-tools">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <!-- form start -->
                                <?php echo form_open(current_url(), array("id" => "create_salary")); ?>
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="position">Position</label>
                                        <input type='text' id='position' name='position'  placeholder="Position" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="amount">Amount</label>
                                        <input type='text' id='amount' name='amount'  placeholder="Amount" class="form-control">
                                    </div>
                                </div>
                                <!-- /.box-body -->

                                <div class="box-footer">
                                    <div class='pull-right'>
                                        <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> </button> &nbsp;
                                        <button type="reset" class="btn btn-primary"><i class="fa fa-refresh"></i> </button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                                
                            </div>
                            
                        </div>
                        <div class="col-md-9">
                             <div class="box box-warning box-solid">
                                <div class="box-header">
                                    <h3 class="box-title">List of Users</h3>
                                    
                                    <div class="box-tools">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <table class="table table-bordered table-striped dataTable" id='salariesTable'>
                                        <thead>
                                            <tr>
                                                <th>Position</th>
                                                <th>Amount</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id='salaries_table'>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                         </div>
                    </div>
                </section>
            </div>
<script src="<?php echo base_url($plugins_dir . '/pwstrength/pwstrength.min.js'); ?>"></script>
<script>

    $(function(){

        getSalaries();

        function getSalaries()
        {
            $('#salariesTable').DataTable().clear();
            $('#salariesTable').DataTable().destroy();
            let request = $.ajax({
                
                url: '<?=base_url('admin/salaries/getSalaries')?>',
                dataType: 'json',
                type: 'GET'                
            });
            request.done(function(data){
                $.each(data, function(index, element){
                        $('#salaries_table').append("<tr><td>"+element.position+"</td><td>"+element.amount+"</td><td><button class='btn btn-warning btn-xs'><i class='fa fa-edit'></i> Edit</button>  <a href='#' class='btn btn-xs btn-danger' id='delete_"+element.id+"' data-placement='top' title='Position's Salary?' data-singleton='true' ><i class='fa fa-trash'></i> Delete</a></td></tr>");
                    });
                    $('#salariesTable').DataTable();
            });
        }

        $('#create_salary').on('submit', function(e){
            e.preventDefault();
            $.ajax({
                url: '<?=base_url('admin/salaries/create')?>',
                data: $(this).serialize(),
                type: 'post',
                dataType: 'json',
                success: function(data){
                    getSalaries();
                    alert(data.status_description);
                }
            });
        });

        $(document).on('mouseover', 'a[id^="delete_"]', function(e){
            e.preventDefault();
            let id = ($(this)[0].id).split('_')[1];
            $('#'+$(this)[0].id+'').confirmation({
                onConfirm: function(){
                    $.ajax({
                        url: '<?=base_url('admin/salaries/delete')?>',
                        data: {'id' : id},
                        type: 'get',
                        dataType: 'json',
                        success: function(data){
                            getSalaries();
                            alert(data.status_description);
                        }
                    });
                },
                onCancel: function(){}
            });
        });

        // $('#table_search').keyup(function(){
        //     var txt = $('#table_search').val();
        //     var filter, table, tr, td, i;
        //     filter = txt.toUpperCase();
        //     table = document.getElementById("userTable");
        //     tr = table.getElementsByTagName("tr");
        //     console.log(tr);
        //     for (i = 0; i < tr.length; i++) {
        //         td1 = tr[i].getElementsByTagName("td")[0];
        //         td2 = tr[i].getElementsByTagName("td")[1];
        //         td3 = tr[i].getElementsByTagName("td")[2];
        //         td4 = tr[i].getElementsByTagName("td")[3];
                
        //         if (td1) {
        //             if (td1.innerHTML.toUpperCase().indexOf(filter) > -1 || td2.innerHTML.toUpperCase().indexOf(filter) > -1 || td3.innerHTML.toUpperCase().indexOf(filter) > -1 || td4.innerHTML.toUpperCase().indexOf(filter) > -1) {
        //                 tr[i].style.display = "";
        //             } else {
        //                 tr[i].style.display = "none";
        //             }
                
        //         }   
                  
        //     }
            
        // });
    });      

</script>