{{--<!-- Parent Id Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--    {!! Form::label('parent_id', 'Parent Id:') !!}--}}
{{--    {!! Form::number('parent_id', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Slug Field -->
<div class="form-group col-sm-6">
    {!! Form::label('slug', 'Slug:') !!}
    {!! Form::text('slug', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Menu Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('menu_name', 'Menu Name:') !!}
    {!! Form::text('menu_name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Canonical Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('canonical_url', 'Canonical Url:') !!}
    {!! Form::text('canonical_url', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Short Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('short_description', 'Short Description:') !!}
    {!! Form::textarea('short_description', null, ['class' => 'form-control']) !!}
</div>

<!-- Content Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('content', 'Content:') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
</div>

<script>
    CKEDITOR.replace( 'content' ,{
        filebrowserBrowseUrl : '/lib/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
        filebrowserUploadUrl : '/lib/filemanager/upload.php?type=2&editor=ckeditor&fldr=',
        filebrowserImageBrowseUrl : '/lib/filemanager/dialog.php?type=1&editor=ckeditor&fldr='
    });

    CKEDITOR.replace( 'short_description' ,{
        filebrowserBrowseUrl : '/lib/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
        filebrowserUploadUrl : '/lib/filemanager/upload.php?type=2&editor=ckeditor&fldr=',
        filebrowserImageBrowseUrl : '/lib/filemanager/dialog.php?type=1&editor=ckeditor&fldr='
    });
</script>

<!-- Image Field -->
<div id='imageContainer' class='form-group fieldContainer page blogpost press page_group special_page_domain video_gallery custom external_link page_link video news content_block'>
    {!! Form::label('image', 'Image:', ['class' => 'col-sm-2 control-label']) !!}

    <div class="col-sm-9" id='imageInnerContainer'>
        <input name='image' id='image' type='file' value='' size='100' maxlength='250' />
        @if ($node->image != "")
            <a href='{{ url($node->image) }}' target='_blank'>{{ $node->image }}</a>
            <input type='checkbox' name='delete_image' id='delete_image' value='1'> <label for='delete_image'>{{ trans("Delete image") }}</label>
        @endif
    </div>
</div>

{{--<!-- Meta Title Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--    {!! Form::label('meta_title', 'Meta Title:') !!}--}}
{{--    {!! Form::text('meta_title', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}--}}
{{--</div>--}}

{{--<!-- Meta Description Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--    {!! Form::label('meta_description', 'Meta Description:') !!}--}}
{{--    {!! Form::text('meta_description', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}--}}
{{--</div>--}}

{{--<!-- Meta Keywords Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--    {!! Form::label('meta_keywords', 'Meta Keywords:') !!}--}}
{{--    {!! Form::text('meta_keywords', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}--}}
{{--</div>--}}

<!-- Published Field -->
<div class="form-group col-sm-6">
    <label class="checkbox-inline">
        {!! Form::hidden('published', 0) !!}
        {!! Form::checkbox('published', '1', null) !!}
    </label>
    {!! Form::label('published', 'Published:') !!}
</div>


<!-- Is Menu Field -->
<div class="form-group col-sm-6">
    <label class="checkbox-inline">
        {!! Form::hidden('is_menu', 0) !!}
        {!! Form::checkbox('is_menu', '1', null) !!}
    </label>
    {!! Form::label('is_menu', 'Is Menu:') !!}
</div>


<!-- Is Sitemap Field -->
<div class="form-group col-sm-6">
    <label class="checkbox-inline">
        {!! Form::hidden('is_sitemap', 0) !!}
        {!! Form::checkbox('is_sitemap', '1', null) !!}
    </label>
    {!! Form::label('is_sitemap', 'Is Sitemap:') !!}
</div>


<!-- Is Homepage Field -->
<div class="form-group col-sm-6">
    <label class="checkbox-inline">
        {!! Form::hidden('is_homepage', 0) !!}
        {!! Form::checkbox('is_homepage', '1', null) !!}
    </label>
    {!! Form::label('is_homepage', 'Is Homepage:') !!}
</div>


<!-- Access Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('access_type', 'Access Type:') !!}
    {!! Form::select('access_type', array('public' => 'Public', 'private' => 'Private'), null, ['class' => 'form-control']) !!}
</div>

<!-- Node Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('node_type', 'Node Type:') !!}
    {!! Form::text('node_type', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Node Properties Field -->
<div class="form-group col-sm-6">
    {!! Form::label('node_properties', 'Node Properties:') !!}
    {!! Form::text('node_properties', null, ['class' => 'form-control']) !!}
</div>

<!-- Display At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('display_at', 'Display At:') !!}
    {!! Form::text('display_at', null, ['class' => 'form-control','id'=>'display_at']) !!}
</div>

@push('scripts')
   <script type="text/javascript">
           $('#display_at').datetimepicker({
               format: 'YYYY-MM-DD HH:mm:ss',
               useCurrent: true,
               icons: {
                   up: "icon-arrow-up-circle icons font-2xl",
                   down: "icon-arrow-down-circle icons font-2xl"
               },
               sideBySide: true
           })
       </script>
@endpush


<!-- Ends At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ends_at', 'Ends At:') !!}
    {!! Form::text('ends_at', null, ['class' => 'form-control','id'=>'ends_at']) !!}
</div>

@push('scripts')
   <script type="text/javascript">
           $('#ends_at').datetimepicker({
               format: 'YYYY-MM-DD HH:mm:ss',
               useCurrent: true,
               icons: {
                   up: "icon-arrow-up-circle icons font-2xl",
                   down: "icon-arrow-down-circle icons font-2xl"
               },
               sideBySide: true
           })
       </script>
@endpush


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.nodes.index') }}" class="btn btn-secondary">Cancel</a>
</div>
