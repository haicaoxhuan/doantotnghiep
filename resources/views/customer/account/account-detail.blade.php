<div class="tab-pane fade" id="account-info" role="tabpanel">
    <div class="myaccount-content">
        <h3>{{trans('language.account_detail')}}</h3>
        <div class="account-details-form">
            <form action="#">
                <div class="single-input-item">
                    <label for="display-name" class="required">{{trans('language.full_name')}}</label>
                    <input type="text" name="full_name" />
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="single-input-item">
                            <label for="first-name" class="required">{{trans('language.email')}}</label>
                            <input type="email" name="email" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="single-input-item">
                            <label for="last-name" class="required">{{trans('language.number_phone')}}</label>
                            <input type="text" name="phone"/>
                        </div>
                    </div>
                </div>
                <fieldset>
                    <legend>{{trans('language.password_change')}}</legend>
                    <div class="single-input-item">
                        <label for="current-pwd" class="required">{{trans('language.current_password')}}</label>
                        <input type="password" name="current_password" />
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="single-input-item">
                                <label for="new-pwd" class="required">{{trans('language.new_password')}}</label>
                                <input type="password" name="new_password"/>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="single-input-item">
                                <label for="confirm-pwd" class="required">{{trans('language.confirm_password')}}</label>
                                <input type="password" name="confirm_password"/>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <div class="single-input-item btn-hover">
                    <button class="check-btn sqr-btn">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>