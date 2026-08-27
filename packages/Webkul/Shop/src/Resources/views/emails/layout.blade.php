<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=Inter:wght@400;500;600&display=swap" rel="stylesheet" />
        <style>
            body { margin: 0; padding: 0; background-color: #FAF8F5; font-family: 'Inter', sans-serif; -webkit-font-smoothing: antialiased; }
            .container { max-width: 600px; margin: 40px auto; background-color: #FFFFFF; border: 1px solid #E5DECB; border-radius: 8px; overflow: hidden; }
            .header { background-color: #163923; padding: 30px 40px; text-align: center; border-bottom: 4px solid #C9A25A; }
            .content { padding: 40px; color: #205132; }
            .footer { background-color: #F5EFE6; padding: 30px 40px; text-align: center; color: #163923; font-size: 13px; border-top: 1px solid #E5DECB; }
            .footer a { color: #83B740; text-decoration: none; font-weight: 500; }
            .btn { display: inline-block; background-color: #C9A25A; color: #FFFFFF !important; padding: 12px 24px; text-decoration: none; border-radius: 4px; font-weight: 500; margin-top: 15px; }
            h1, h2, h3 { font-family: 'DM Serif Display', serif; color: #163923; font-weight: normal; margin-top: 0; }
            p { line-height: 1.6; margin-bottom: 20px; }
            a { color: #83B740; text-decoration: none; }
            .table-container { width: 100%; border-collapse: collapse; margin-top: 20px; margin-bottom: 20px; }
            .table-container th { border-bottom: 2px solid #E5DECB; padding: 12px 8px; text-align: left; color: #163923; font-weight: 600; font-size: 14px; }
            .table-container td { border-bottom: 1px solid #EBF3EE; padding: 12px 8px; color: #205132; font-size: 14px; }
            .summary-box { background-color: #FAF8F5; padding: 20px; border-radius: 6px; border: 1px solid #E5DECB; margin-top: 20px; }
        </style>
    </head>
    <body>
        <div class="container">
            <!-- Email Header -->
            <div class="header">
                <a href="{{ route('shop.home.index') }}">
                    @if ($logo = core()->getCurrentChannel()->logo_url)
                        <img src="{{ $logo }}" alt="{{ config('app.name') }}" style="max-height: 50px; max-width: 200px;" />
                    @else
                        <!-- ELIOR Text Logo Fallback -->
                        <span style="font-family: 'DM Serif Display', serif; font-size: 32px; color: #FAF8F5; letter-spacing: 2px;">ELIOR</span>
                    @endif
                </a>
            </div>

            <!-- Email Content -->
            <div class="content">
                {{ $slot }}
            </div>

            <!-- Email Footer -->
            <div class="footer">
                <p style="margin-bottom: 10px;">
                    @lang('shop::app.emails.thanks', [
                        'link' => 'mailto:' . core()->getContactEmailDetails()['email'],
                        'email' => core()->getContactEmailDetails()['email'],
                        'style' => 'color: #83B740; font-weight: 600;'
                    ])
                </p>
                <p style="margin-bottom: 0; font-size: 12px; color: #666;">
                    &copy; {{ date('Y') }} ELIOR Natural Powders. All rights reserved.
                </p>
            </div>
        </div>
    </body>
</html>
