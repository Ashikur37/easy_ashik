@extends('layouts.admin',['headerText' => $lng->NotificationSetting])
@section('title', "$lng->NotificationSetting")
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/page/static.css">
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{ $lng->NotificationSetting }}</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="site-customization">
            <div class="row">
                <div class="col-md-6">
                   <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">{{ $lng->Admin }}</th>
                                    <th scope="col">{{ $lng->WebsiteNotification }}</th>
                                    <th scope="col">{{ $lng->MailNotification }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $lng->NewCustomer }}</td>
                                    <td>
                                        <label class="ts-swich-label">
                                            <input {{ $notificationSetting->admin_db_new_user ? 'checked' : '' }}
                                                data-key="admin_db_new_user" type="checkbox" class="switch ts-swich-input">
                                            <span class="ts-swich-body"></span></label>
                                    </td>
                                    <td>
                                        <label class="ts-swich-label">
                                            <input {{ $notificationSetting->admin_mail_new_user ? 'checked' : '' }}
                                                data-key="admin_mail_new_user" type="checkbox" class="switch ts-swich-input">
                                            <span class="ts-swich-body"></span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ $lng->NewOrder }}</td>
                                    <td>
                                        <label class="ts-swich-label">
                                            <input {{ $notificationSetting->admin_db_new_order ? 'checked' : '' }}
                                                data-key="admin_db_new_order" type="checkbox" class="switch ts-swich-input">
                                            <span class="ts-swich-body"></span></label>
                                    </td>
                                    <td>
                                        <label class="ts-swich-label">
                                            <input {{ $notificationSetting->admin_mail_new_order ? 'checked' : '' }}
                                                data-key="admin_mail_new_order" type="checkbox" class="switch ts-swich-input">
                                            <span class="ts-swich-body"></span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td> {{ $lng->NewTicket }}</td>
                                    <td>
                                        <label class="ts-swich-label">
                                            <input {{ $notificationSetting->admin_db_new_ticket ? 'checked' : '' }}
                                                data-key="admin_db_new_ticket" type="checkbox" class="switch ts-swich-input">
                                            <span class="ts-swich-body"></span></label>
                                    </td>
                                    <td>
                                        <label class="ts-swich-label">
                                            <input {{ $notificationSetting->admin_mail_new_ticket ? 'checked' : '' }}
                                                data-key="admin_mail_new_ticket" type="checkbox" class="switch ts-swich-input">
                                            <span class="ts-swich-body"></span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td> {{ $lng->TicketReply }}</td>
                                    <td>
                                        <label class="ts-swich-label">
                                            <input {{ $notificationSetting->admin_db_ticket_reply ? 'checked' : '' }}
                                                data-key="admin_db_ticket_reply" type="checkbox" class="switch ts-swich-input">
                                            <span class="ts-swich-body"></span></label>
                                    </td>
                                    <td>
                                        <label class="ts-swich-label">
                                            <input {{ $notificationSetting->admin_mail_ticket_reply ? 'checked' : '' }}
                                                data-key="admin_mail_ticket_reply" type="checkbox"
                                                class="switch ts-swich-input">
                                            <span class="ts-swich-body"></span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ $lng->NewWithdraw }}</td>
                                    <td>
                                        <label class="ts-swich-label">
                                            <input {{ $notificationSetting->admin_db_withdraw ? 'checked' : '' }}
                                                data-key="admin_db_withdraw" type="checkbox" class="switch ts-swich-input">
                                            <span class="ts-swich-body"></span></label>
                                    </td>
                                    <td>
                                        <label class="ts-swich-label">
                                            <input {{ $notificationSetting->admin_mail_withdraw ? 'checked' : '' }}
                                                data-key="admin_mail_withdraw" type="checkbox" class="switch ts-swich-input">
                                            <span class="ts-swich-body"></span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ $lng->ProductReview }}</td>
                                    <td>
                                        <label class="ts-swich-label">
                                            <input {{ $notificationSetting->admin_db_product_review ? 'checked' : '' }}
                                                data-key="admin_db_product_review" type="checkbox"
                                                class="switch ts-swich-input">
                                            <span class="ts-swich-body"></span></label>
                                    </td>
                                    <td>
                                        <label class="ts-swich-label">
                                            <input {{ $notificationSetting->admin_mail_product_review ? 'checked' : '' }}
                                                data-key="admin_mail_product_review" type="checkbox"
                                                class="switch ts-swich-input">
                                            <span class="ts-swich-body"></span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ $lng->ProductComment }}</td>
                                    <td>
                                        <label class="ts-swich-label">
                                            <input {{ $notificationSetting->admin_db_product_comment ? 'checked' : '' }}
                                                data-key="admin_db_product_comment" type="checkbox"
                                                class="switch ts-swich-input">
                                            <span class="ts-swich-body"></span></label>
                                    </td>
                                    <td>
                                        <label class="ts-swich-label">
                                            <input {{ $notificationSetting->admin_mail_product_comment ? 'checked' : '' }}
                                                data-key="admin_mail_product_comment" type="checkbox"
                                                class="switch ts-swich-input">
                                            <span class="ts-swich-body"></span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ $lng->ProductCommentReply }}</td>
                                    <td>
                                        <label class="ts-swich-label">
                                            <input {{ $notificationSetting->admin_db_product_comment_reply ? 'checked' : '' }}
                                                data-key="admin_db_product_comment_reply" type="checkbox"
                                                class="switch ts-swich-input">
                                            <span class="ts-swich-body"></span></label>
                                    </td>
                                    <td>
                                        <label class="ts-swich-label">
                                            <input {{ $notificationSetting->admin_mail_product_comment_reply ? 'checked' : '' }}
                                                data-key="admin_mail_product_comment_reply" type="checkbox"
                                                class="switch ts-swich-input">
                                            <span class="ts-swich-body"></span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ $lng->BlogComment }}</td>
                                    <td>
                                        <label class="ts-swich-label">
                                            <input {{ $notificationSetting->admin_db_blog_comment ? 'checked' : '' }}
                                                data-key="admin_db_blog_comment" type="checkbox" class="switch ts-swich-input">
                                            <span class="ts-swich-body"></span></label>
                                    </td>
                                    <td>
                                        <label class="ts-swich-label">
                                            <input {{ $notificationSetting->admin_mail_blog_comment ? 'checked' : '' }}
                                                data-key="admin_mail_blog_comment" type="checkbox"
                                                class="switch ts-swich-input">
                                            <span class="ts-swich-body"></span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ $lng->BlogCommentReply }}</td>
                                    <td>
                                        <label class="ts-swich-label">
                                            <input {{ $notificationSetting->admin_db_blog_comment_reply ? 'checked' : '' }}
                                                data-key="admin_db_blog_comment_reply" type="checkbox"
                                                class="switch ts-swich-input">
                                            <span class="ts-swich-body"></span></label>
                                    </td>
                                    <td>
                                        <label class="ts-swich-label">
                                            <input {{ $notificationSetting->admin_mail_blog_comment_reply ? 'checked' : '' }}
                                                data-key="admin_mail_blog_comment_reply" type="checkbox"
                                                class="switch ts-swich-input">
                                            <span class="ts-swich-body"></span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ $lng->ContactFormSubmit }}</td>
                                    <td>
                                        <label class="ts-swich-label">
                                            <input {{ $notificationSetting->admin_db_contact_form ? 'checked' : '' }}
                                                data-key="admin_db_contact_form" type="checkbox" class="switch ts-swich-input">
                                            <span class="ts-swich-body"></span></label>
                                    </td>
                                    <td>
                                        <label class="ts-swich-label">
                                            <input {{ $notificationSetting->admin_mail_contact_form ? 'checked' : '' }}
                                                data-key="admin_mail_contact_form" type="checkbox"
                                                class="switch ts-swich-input">
                                            <span class="ts-swich-body"></span>
                                        </label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                   </div>
                </div>
                <div class="col-md-6 mt-4 mt-md-0">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">{{ $lng->Customer }}</th>
                                    <th scope="col">{{ $lng->WebsiteNotification }}</th>
                                    <th scope="col">{{ $lng->MailNotification }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $lng->OrderSuccess }}</td>
                                    <td>
                                        <label class="ts-swich-label">
                                            <input {{ $notificationSetting->user_db_order_success ? 'checked' : '' }}
                                                data-key="user_db_order_success" type="checkbox" class="switch ts-swich-input">
                                            <span class="ts-swich-body"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="ts-swich-label">
                                            <input {{ $notificationSetting->user_mail_order_success ? 'checked' : '' }}
                                                data-key="user_mail_order_success" type="checkbox"
                                                class="switch ts-swich-input">
                                            <span class="ts-swich-body"></span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ $lng->OrderUpdate }}</td>
                                    <td>
                                        <label class="ts-swich-label">
                                            <input {{ $notificationSetting->user_db_order_update ? 'checked' : '' }}
                                                data-key="user_db_order_update" type="checkbox" class="switch ts-swich-input">
                                            <span class="ts-swich-body"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="ts-swich-label">
                                            <input {{ $notificationSetting->user_mail_order_update ? 'checked' : '' }}
                                                data-key="user_mail_order_update" type="checkbox" class="switch ts-swich-input">
                                            <span class="ts-swich-body"></span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ $lng->WithdrawUpdate }}</td>
                                    <td>
                                        <label class="ts-swich-label">
                                            <input {{ $notificationSetting->user_db_withdraw_update ? 'checked' : '' }}
                                                data-key="user_db_withdraw_update" type="checkbox"
                                                class="switch ts-swich-input">
                                            <span class="ts-swich-body"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="ts-swich-label">
                                            <input {{ $notificationSetting->user_mail_withdraw_update ? 'checked' : '' }}
                                                data-key="user_mail_withdraw_update" type="checkbox"
                                                class="switch ts-swich-input">
                                            <span class="ts-swich-body"></span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ $lng->BalanceUpdate }}</td>
                                    <td>
                                        <label class="ts-swich-label">
                                            <input {{ $notificationSetting->user_db_balance_update ? 'checked' : '' }}
                                                data-key="user_db_balance_update" type="checkbox" class="switch ts-swich-input">
                                            <span class="ts-swich-body"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="ts-swich-label">
                                            <input {{ $notificationSetting->user_mail_balance_update ? 'checked' : '' }}
                                                data-key="user_mail_balance_update" type="checkbox"
                                                class="switch ts-swich-input">
                                            <span class="ts-swich-body"></span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ $lng->ProductCommentReply }}</td>
                                    <td>
                                        <label class="ts-swich-label">
                                            <input {{ $notificationSetting->user_db_product_comment_reply ? 'checked' : '' }}
                                                data-key="user_db_product_comment_reply" type="checkbox"
                                                class="switch ts-swich-input">
                                            <span class="ts-swich-body"></span></label>
                                    </td>
                                    <td>
                                        <label class="ts-swich-label">
                                            <input {{ $notificationSetting->user_mail_product_comment_reply ? 'checked' : '' }}
                                                data-key="user_mail_product_comment_reply" type="checkbox"
                                                class="switch ts-swich-input">
                                            <span class="ts-swich-body"></span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ $lng->BlogCommentReply }}</td>
                                    <td>
                                        <label class="ts-swich-label">
                                            <input {{ $notificationSetting->user_db_blog_comment_reply ? 'checked' : '' }}
                                                data-key="user_db_blog_comment_reply" type="checkbox"
                                                class="switch ts-swich-input">
                                            <span class="ts-swich-body"></span></label>
                                    </td>
                                    <td>
                                        <label class="ts-swich-label">
                                            <input {{ $notificationSetting->user_mail_blog_comment_reply ? 'checked' : '' }}
                                                data-key="user_mail_blog_comment_reply" type="checkbox"
                                                class="switch ts-swich-input">
                                            <span class="ts-swich-body"></span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ $lng->TicketReply }}</td>
                                    <td>
                                        <label class="ts-swich-label">
                                            <input {{ $notificationSetting->user_db_ticket_reply ? 'checked' : '' }}
                                                data-key="user_db_ticket_reply" type="checkbox" class="switch ts-swich-input">
                                            <span class="ts-swich-body"></span></label>
                                    </td>
                                    <td>
                                        <label class="ts-swich-label">
                                            <input {{ $notificationSetting->user_mail_ticket_reply ? 'checked' : '' }}
                                                data-key="user_mail_ticket_reply" type="checkbox" class="switch ts-swich-input">
                                            <span class="ts-swich-body"></span>
                                        </label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function() {
            $(".ts-swich-input").on('change', function() {
                var status = $(this).prop('checked') ? 1 : 0;
                var key = $(this).data('key')
                var url = "{{ URL::to('/admin/notification') }}/" + key + '/' + status;
                $.ajax({
                    url: url,
                    type: 'get'
                }).always(function(data) {
                    toastr.success(data);
                });
            });
        });
    </script>
@endsection
