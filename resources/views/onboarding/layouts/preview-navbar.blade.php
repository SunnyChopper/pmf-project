<div style="width: 100%; background-color: black; padding: 16px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <h3 style="color: white; margin: 0px;">Preview</h3>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <form action="/onboarding/create-optin-page" method="post">
                    @csrf
                    <input type="hidden" name="landing_page_name" value="{{ $data->landing_page_name }}">
                    <input type="hidden" name="template_id" value="{{ $data->template_id }}">
                    @foreach($xml_tags as $tag => $tag_info)
                        <input type="hidden" name="{{ $tag }}" value="{{ $data->$tag }}">
                    @endforeach
                    <input type="submit" class="btn btn-sm btn-primary" style="float: right;" value="Publish">
                </form>
            </div>
        </div>
    </div>
</div>