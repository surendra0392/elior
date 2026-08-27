@component('admin::emails.layout')
    <div style="margin-bottom: 34px;">
        <p style="font-weight: bold;font-size: 20px;color: #163923;line-height: 24px;margin-bottom: 24px">
            @lang('admin::app.emails.dear', ['admin_name' => core()->getAdminEmailDetails()['name']]), 👋
        </p>

        <p style="font-size: 16px;color: #205132;line-height: 24px;">
            {!! trans('admin::app.emails.customers.registration.greeting', [
                'customer_name' => '<a href="' . route('admin.customers.customers.view', $customer->id) . '" style="color: #83B740;">'.$customer->name. '</a>'
                ])
            !!}
        </p>
    </div>

    <p style="font-size: 16px;color: #205132;line-height: 24px;margin-bottom: 40px">
        @lang('admin::app.emails.customers.registration.description')
    </p>
@endcomponent