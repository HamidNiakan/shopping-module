<div class="width-100 mlg-15">
    <input type="{{$type}}" name="{{$name}}"
           placeholder="{{$placeholder}}"
           {{$attributes->merge(['class' => 'text width-100'])}}
           value="{{old($name)}}"
    >
    <x-validation-error field="{{$name}}"/>
</div>
