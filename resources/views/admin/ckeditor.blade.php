<?php
/**
 * Created by PhpStorm.
 * User: laziestcoder
 * Date: 09-Sep-18
 * Time: 1:29 AM
 */
?>

<div class="form-group {!! !$errors->has($errorKey) ?: 'has-error' !!}">

    <label for="{{$id}}" class="col-sm-2 control-label">{{$label}}</label>

    <div class="col-sm-6">

        @include('admin::form.error')

        <textarea class="form-control {{$class}}" id="{{$id}}" name="{{$name}}"
                  placeholder="{{ $placeholder }}" {!! $attributes !!} >{{ old($column, $value) }}</textarea>

        @include('admin::form.help-block')

    </div>
</div>