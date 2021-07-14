<script type="text/javascript">

$( document ).ready(function() {

    $("#relType").change(function(){
        $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("value");

            if(optionValue == 1)
            {
               $(".btnVisilein").hide();
               $(".btnHidein").show();
               $(".showYes").show();

            } else{

              $(".btnVisilein").show();
              $(".btnHidein").hide();
              $(".showYes").hide();
            }
        });
    }).change();


});
</script>

<?php $baseID = $this->input->get('baseID',TRUE); ?>
<?php 
    $householdvisitID = 0;
    $any_relation = 0;
     $interview_date = '';

    if (!empty($householdVisit)) 
    { 

        $householdvisitID = $householdVisit[0]->id; 
        $any_relation = $householdVisit[0]->any_relation; 
         $interview_date = $householdVisit[0]->interview_date; 

    } 

?>

                    <form action="<?php echo base_url().'householdvisit/relation?baseID='.$baseID ?>" id="myForm" role="form" data-toggle="validator" method="post" accept-charset="utf-8">

                    <!-- SmartWizard html -->
                  
                           
                     
                            <div id="relation" style="padding-left: 20px; padding-right: 20px">
                                <h4>Member Relation</h4>
                                <div class="row">
                                     <div class="col-md-4">
                                          <p>Household Code : <?php echo $householdcode ?></p>
                                     </div>
                                      <div class="col-md-4">
                                         <p>Round Number :  <?php echo $roundNo ?></p>
                                     </div>
                                      <div class="col-md-4">
                                         <p>Last Interview Date : <?php if(!empty($interview_date)) { echo date('j F Y', strtotime($interview_date)) ;} ?></p>
                                     </div>
                                </div>

                                <div id="form-step-0" role="form" data-toggle="validator">
                                    <div class="form-group">
                                        <label for="email">Any Relation change during this period?</label>
                                       
                                         <select name="relType" id="relType" class="form-control" required style="">
                                             <option value="">Please Select</option>
                                             <option <?php if ($any_relation == 1) { echo "selected=selected"; } ?> value="1">Yes</option>
                                             <option <?php if ($any_relation == 2) { echo "selected=selected"; } ?> value="2">No</option>
                                         </select>
                                       
                                    </div>
                                </div>

                                <div class="showYes">

                                <fieldset class="scheduler-border">
                                <legend class="scheduler-border">Relation change during this round</legend>
                                <div class="table-responsive">
                                 <table class="table table-striped table-bordered">
                                    <?php if(!empty($relationRecords)) { ?>
                                    <tr>
                                        <td width="1%">#</td>
                                        <td> RID </td>
                                        <td> Name </td>
                                        <td> Birth date </td>
                                        <td> Relation to Head </td>
                                        <td class="pull-right"> Action </td>

                                    </tr>
                                    <?php $i=1;
                                    foreach ($relationRecords as $relation): ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td> <?php echo $relation->member_code ?> </td>
                                        <td> <?php echo $relation->member_name ?> </td>
                                        <td> <?php echo date('j F Y', strtotime($relation->birth_date)); ?> </td>
                                        <td> <?php echo $relation->relationName ?> </td>
                                         <td class="pull-right"> <a title="view/edit" href="<?php echo base_url().'memberRelation/addEditRelation/'.$relation->id.'?household_master_id='.$relation->household_master_id.'&&member_master_id='.$relation->member_master_id.'&&baseID='.$baseID.'#relation'  ?>" class="btn btn-info"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> view/edit </a></td>

                                    </tr>
                                        
                                    <?php  $i = $i + 1;
                                    endforeach ?>
                                    <?php } ?>
                                 </table>
                                </div>
                                </fieldset>

                                <fieldset class="scheduler-border">
                                <legend class="scheduler-border">Present member list</legend>

                                <div class="table-responsive">
                                 <table class="table table-striped table-bordered">
                                    <?php if(!empty($presentMemberList)) { ?>
                                    
                                    <tr>
                                        <td width="1%">#</td>
                                        <td> RID</td>
                                        <td> CID</td>
                                        <td> Name </td>
                                        <td> Birth date </td>
                                        <td> Relation to Head </td>
                                        <td class="pull-right"> Action </td>

                                    </tr>
                                    <?php $i=1;
                                    foreach ($presentMemberList as $presentMember): ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td> <?php echo $presentMember->member_code ?> </td>
                                        <td> <?php echo $presentMember->current_indenttification_id ?> </td>
                                        <td> <?php echo $presentMember->member_name ?> </td>
                                        <td> <?php echo date('j F Y', strtotime($presentMember->birth_date)); ?> </td>
                                        <td> <?php echo $presentMember->relationHead; ?></td>
                                        <td class="pull-right"> <a title="Add Relation" href="<?php echo base_url().'memberRelation/addRelation/'.$presentMember->id.'?household_master_id='.$presentMember->household_master_id_hh.'&&baseID='.$baseID.'#relation'  ?>" class="btn btn-info"> <i class="fa fa-plus" aria-hidden="true"></i> Relation </a>

                                         </td>

                                    </tr>
                                        
                                    <?php  $i = $i + 1;
                                    endforeach ?>
                                    <?php } ?>
                                 </table>
                                </div>
                                </fieldset>
                             </div>

                            </div>

                             <div class="box-footer" style="margin-left: 10px">
                                <input type="hidden" name="household_master_id_sub" value="<?php echo  $household_master_id_sub  ?>">
                                <input type="hidden" name="round_master_id" value="<?php echo  $round_master_id  ?>">
                                <input type="hidden" name="householdVisitID" value="<?php echo  $householdvisitID  ?>">
                                <input type="hidden" name="event" value="relation">
                                <a class="btn btn-success" href="<?php echo base_url().'householdvisit/occupation?baseID='.$baseID.'#occupation' ?>" class="">Previous </a>
                                <input type="submit" class="btn btn-primary btnVisilein" name="submit" value="Save & Next" />
                                <input type="submit" class="btn btn-primary btnHidein" name="submit" value="Next" />
                               
                            </div>
                           
                       

                     </form>
                   
                  
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>

