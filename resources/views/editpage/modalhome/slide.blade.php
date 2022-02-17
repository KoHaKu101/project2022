 <div class="modal fade" id="modalslide" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="row">
                 <div class="col-md-12">
                     <div class="modal-header bg-primary">
                         <h3 class="modal-title" id="MODAL_NAME_SLIDE"></h3>
                         <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>
                     <div class="modal-body">
                         <form method="POST" id="FRM_UPLOAD" action="{{ route('slide.upload') }}"
                             enctype="multipart/form-data">
                             @csrf
                             <input type="hidden" id="NUMBER_SLIDE" name="NUMBER_SLIDE">
                             <div class="row">
                                 <div class="col-md-8">
                                     <div class="mb-3">
                                         <input type="file" class="form-control " id="FILE_IMG" name="FILE_IMG"
                                             required>
                                     </div>
                                 </div>
                                 <div class="col-md-4">
                                     <div class="mb-3 ">
                                         <button type="submit" class="btn btn-success w-100">อัพโหลด</button>
                                     </div>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col-md-12">
                                     <div class="mb-3">
                                         <img id="category-img-tag" class="w-100" style="height: 432px">
                                     </div>
                                 </div>
                             </div>
                         </form>
                     </div>
                 </div>
             </div>

         </div>
     </div>
 </div>
