<div class="file-upload">
    <div class="i-file-upload">
        <span>{{$placeHolder}}</span>
        <input type="file" class="file-upload" id="files"
               name="{{$name}}"/>
    </div>
    <span class="filesize"></span>
    <span class="selectedFiles">فایلی انتخاب نشده است</span>
</div>
@if($value)
    <img src="{{asset('storage/'.$value)}}" width="80">
@endif
<x-validation-error field="{{$name}}"/>