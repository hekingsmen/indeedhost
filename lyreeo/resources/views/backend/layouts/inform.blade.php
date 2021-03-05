<div class="modal fade " id="status_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  {{Form::open(array('url'=>route('doneButActiveEmail'), 'class'=>'ajax-submit', 'id'=>'reminderEmail'))}}
      <div class="modal-dialog modal-homepage reminder-modal" role="document">
         <div class="modal-content">
           
              <div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <h5 class="modal-title" id="status_heading"></h5>
              </div>
               
              <div class="modal-body">
                <h4 style="color: #2D2E87;" id="status_message"></h4>
              </div>

              <div class="modal-footer">
                  <a href="javascript:void(0)"></a>
                  <input type="hidden" name="project_id" id="project_id" value="">
                  <button type="submit" class="btn btn-primary pop-btn" > {!! __('sentence.project_status.inform_email') !!} </button>
              </div>
         </div>
     </div>
  {{Form::close()}}
</div>
