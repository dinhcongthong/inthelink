@extends('layouts.home')


@section('content')

<div class="app-content content d-flex flex-column justify-content-center">
    <div class="content-wrapper register">
        <div class="content-header row mb-1">
        </div>
        <div class="content-body">
            <section class="flexbox-container">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="col-lg-5 col-md-8 col-12 box-shadow-2 p-0">
                        <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                            <div class="card-header border-0 pb-0">
                                <div class="card-title text-center">
                                    <img src="{{ asset('images/logo/logo.png') }}" class="my-1" width="200"
                                        alt="branding logo">
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form-horizontal form needs-validation" id="form_register"
                                        action="{{ route('post_register', ['position' => $segment2]) }}" method="POST"
                                        novalidate="">
                                        @csrf
                                        <div class="col-sm-12 p-0">
                                            @if ($errors->any())
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <strong>Error !</strong>
                                                @foreach ($errors->all() as $item)
                                                {{ $item }}
                                                <br>
                                                @endforeach
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            @endif
                                        </div>
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="email" class="form-control" name="email"
                                                value="{{ old('email') ?? '' }}" placeholder="email@gmail.com" required>
                                            <div class="invalid-feedback invalid-feedback-email">Email is required
                                            </div>
                                            <div class="form-control-position">
                                                <i class="ft-mail"></i>
                                            </div>
                                        </fieldset>
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="password" class="pass form-control" name="password"
                                                placeholder="Password" required>
                                            <div class="invalid-feedback invalid-feedback-pass">Password is required
                                            </div>
                                            <div class="form-control-position">
                                                <i class="la la-key"></i>
                                            </div>
                                        </fieldset>
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="password" class="pass form-control" name="password_confirm"
                                                placeholder="Confirm password" required>
                                            <div class="invalid-feedback invalid-feedback-pass">Password is required
                                            </div>
                                            <div class="form-control-position">
                                                <i class="la la-key"></i>
                                            </div>
                                        </fieldset>
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="text" class="form-control" value="{{ old('phone') ?? '' }}"
                                                name="phone" placeholder="01000-0000-0" required>
                                            <div class=" invalid-feedback invalid-feedback-phone">Phone is required
                                            </div>
                                            <div class="form-control-position">
                                                <i class="la la-phone"></i>
                                            </div>
                                        </fieldset>
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="text" class="form-control" placeholder="User Name"
                                                name="user_name" value="{{ old('user_name') ?? '' }}" required>
                                            <div class="invalid-feedback invalid-feedback-user_name">User name is
                                                required
                                            </div>
                                            <div class="form-control-position">
                                                <i class="la la-user"></i>
                                            </div>
                                        </fieldset>
                                        {{-- <fieldset class="form-group position-relative has-icon-left">
                                            <select class="custom-select d-block w-100 pl-3" id="" name="gender"
                                                data-toggle="tooltip" data-placement="top" title=""
                                                data-original-title="Gender">
                                                <option value="0" {{ old('gender') == 0 ? 'selected' : '' }}>Female
                                                </option>
                                                <option value="1" {{ old('gender') == 1 ? 'selected' : '' }}>Male
                                                </option>
                                                <option value="2" {{ old('gender') == 2 ? 'selected' : '' }}>Other
                                                </option>
                                            </select>
                                            <div class="form-control-position">
                                                <i class="la la-user"></i>
                                            </div>
                                        </fieldset>
                                        <fieldset class="form-group position-relative has-icon-left select-group"
                                            data-birthday="2002-11-19">
                                            <div class="form-group mb-0 d-flex select-group flex-wrap">
                                                <div class="col-12 col-lg-4 px-0 pb-2 py-lg-0">
                                                    <div class="select-wrap ">
                                                        <select class="custom-select" required name="date" id=""
                                                            data-toggle="tooltip" data-placement="top" title=""
                                                            data-original-title="Day of Birth">
                                                            <option disabled hidden selected value>Date</option>
                                                        </select>
                                                        <i class="fas fa-chevron-down"></i>
                                                        <div class=" invalid-feedback invalid-feedback-date">Date is
                                                            required</div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-4 px-0 pb-2 py-lg-0 px-lg-2">
                                                    <div class="select-wrap">
                                                        <select class="custom-select" required name="month" id=""
                                                            data-toggle="tooltip" data-placement="top" title=""
                                                            data-original-title="Month of Birth">
                                                            <option selected disabled hidden value>Month</option>
                                                        </select>
                                                        <i class="fas fa-chevron-down"></i>
                                                        <div class=" invalid-feedback invalid-feedback-month">Month is
                                                            required</div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-4 px-0 pb-2 py-lg-0">
                                                    <div class="select-wrap">
                                                        <select class="custom-select" required name="year" id=""
                                                            data-toggle="tooltip" data-placement="top" title=""
                                                            data-original-title="Year of Birth">
                                                            <option selected disabled hidden value>Year</option>
                                                        </select>
                                                        <i class="fas fa-chevron-down"></i>
                                                        <div class=" invalid-feedback invalid-feedback-year">Year is
                                                            requireed</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset> --}}

                                        <div class="social social-influencer mb-2">
                                            @if ($segment2 == 'influencer')
                                            <p
                                                class="card-subtitle line-on-side text-muted text-center font-small-5 mx-2 mb-2 mt-3">
                                                <span>Social</span></p>
                                            <label class="text-center w-100">Choose social account which posted your
                                                product</label>
                                            <input name="social" class="d-none">
                                            <div class="d-flex flex-wrap justify-content-center align-items-center">
                                                <button class="btn btn-warning d-block btn-add-social mx-1 mb-1">Add new
                                                    social</button>
                                            </div>
                                            <fieldset class="form-group position-relative has-icon-left social-group">
                                                <input class="form-control" type="text" name="social[]"
                                                    value="{{ old('social') ? old('social')[0] : '' }}" required=""
                                                    placeholder="https://abcxyz.xxx">
                                                <div class="invalid-feedback text-center">
                                                    Please fill your social account(s)
                                                </div>
                                                <div class="form-control-position">
                                                    <i class="ft-share-2"></i>
                                                </div>
                                            </fieldset>
                                            <p
                                                class="card-subtitle line-on-side text-muted text-center font-small-5 mx-2 mb-2 mt-3">
                                                <span>Bank info</span></p>
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="text" name="bank_name" placeholder="Bank name"
                                                    value="{{ old('bank_name') ?? '' }}" required class="form-control">
                                                <div class=" invalid-feedback invalid-feedback-idcard">Please fill your
                                                    bank name</div>
                                                <div class="form-control-position">
                                                    <i class="la la-bank"></i>
                                                </div>
                                            </fieldset>
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="text" name="bank_acc_num" value="{{ old('bank_acc_num') }}"
                                                    placeholder="Bank account number" required class="form-control">
                                                <div class=" invalid-feedback invalid-feedback-idcard">Please fill your
                                                    bank's account number</div>
                                                <div class="form-control-position">
                                                    <i class="la la-credit-card"></i>
                                                </div>
                                            </fieldset>
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="text" name="bank_acc_name"
                                                    value="{{ old('bank_acc_name') }}" placeholder="Bank account name"
                                                    required class="form-control">
                                                <div class=" invalid-feedback invalid-feedback-idcard">Please fill your
                                                    bank's account name</div>
                                                <div class="form-control-position">
                                                    <i class="la la-credit-card"></i>
                                                </div>
                                            </fieldset>
                                            @endif
                                            <div class="term p-2 border-light rounded border">
                                                <div class="term__box">
                                                    <div class="term__box-item overflow-auto" style="height: 80vh;">
                                                        <div class="d-flex">
                                                            <p class="term__box-type">Welcome to InTheLink</p>

                                                        </div>
                                                        <p class="term__box-title">Title of internal web page</p>
                                                        <p class="term__box-content">
                                                            These terms and conditions outline the rules and regulations
                                                            for the use of InTheLink's Website.
                                                            InTheLink is located at: 
                                                            <br>
                                                            <br>
                                                            By accessing this website we assume you accept these terms
                                                            and conditions in full. Do not continue to use InTheLink's
                                                            website
                                                            if you do not accept all of the terms and conditions stated
                                                            on this page.
                                                            The following terminology applies to these Terms and
                                                            Conditions, Privacy Statement and Disclaimer Notice
                                                            and any or all Agreements: "Client", "You" and "Your" refers
                                                            to you, the person accessing this website
                                                            and accepting the Company's terms and conditions. "The
                                                            Company", "Ourselves", "We", "Our" and "Us", refers
                                                            to our Company. "Party", "Parties", or "Us", refers to both
                                                            the Client and ourselves, or either the Client
                                                            or ourselves. All terms refer to the offer, acceptance and
                                                            consideration of payment necessary to undertake
                                                            the process of our assistance to the Client in the most
                                                            appropriate manner, whether by formal meetings
                                                            of a fixed duration, or any other means, for the express
                                                            purpose of meeting the Client's needs in respect
                                                            of provision of the Company's stated services/products, in
                                                            accordance with and subject to, prevailing law
                                                            of . Any use of the above terminology or other words in the
                                                            singular, plural,
                                                            capitalisation and/or he/she or they, are taken as
                                                            interchangeable and therefore as referring to same.Cookies
                                                            We employ the use of cookies. By using InTheLink's website
                                                            you consent to the use of cookies
                                                            in accordance with InTheLink's privacy policy.Most of the
                                                            modern day interactive web sites
                                                            use cookies to enable us to retrieve user details for each
                                                            visit. Cookies are used in some areas of our site
                                                            to enable the functionality of this area and ease of use for
                                                            those people visiting. Some of our
                                                            affiliate / advertising partners may also use
                                                            cookies.License
                                                            Unless otherwise stated, InTheLink and/or it's licensors own
                                                            the intellectual property rights for
                                                            all material on InTheLink. All intellectual property rights
                                                            are reserved. You may view and/or print
                                                            pages from http://inthelink.net for your own personal use
                                                            subject to restrictions set in these terms and conditions.
                                                            You must not:<br>
                                                            <br>
                                                            Republish material from http://inthelink.net
                                                            Sell, rent or sub-license material from http://inthelink.net
                                                            Reproduce, duplicate or copy material from
                                                            http://inthelink.net<br>
                                                            <br>
                                                            Redistribute content from InTheLink (unless content is
                                                            specifically made for redistribution).
                                                            Hyperlinking to our Content<br>
                                                            <br>
                                                            The following organizations may link to our Web site without
                                                            prior written approval:<br>
                                                            <br>
                                                            Government agencies;
                                                            Search engines;
                                                            News organizations;
                                                            Online directory distributors when they list us in the
                                                            directory may link to our Web site in the same
                                                            manner as they hyperlink to the Web sites of other listed
                                                            businesses; and
                                                            Systemwide Accredited Businesses except soliciting
                                                            non-profit organizations, charity shopping malls,
                                                            and charity fundraising groups which may not hyperlink to
                                                            our Web site.
                                                            <br>
                                                            <br>
                                                            These organizations may link to our home page, to
                                                            publications or to other Web site information so long
                                                            as the link: (a) is not in any way misleading; (b) does not
                                                            falsely imply sponsorship, endorsement or
                                                            approval of the linking party and its products or services;
                                                            and (c) fits within the context of the linking
                                                            party's site.<br>
                                                            <br>
                                                            We may consider and approve in our sole discretion other
                                                            link requests from the following types of organizations:
                                                            <br>
                                                            commonly-known consumer and/or business information sources
                                                            such as Chambers of Commerce, American
                                                            Automobile Association, AARP and Consumers Union;
                                                            dot.com community sites;
                                                            associations or other groups representing charities,
                                                            including charity giving sites, online directory
                                                            distributors; internet portals;
                                                            accounting, law and consulting firms whose primary clients
                                                            are businesses; and
                                                            educational institutions and trade associations.
                                                            <br>
                                                            <br>
                                                            We will approve link requests from these organizations if we
                                                            determine that: (a) the link would not reflect
                                                            unfavorably on us or our accredited businesses (for example,
                                                            trade associations or other organizations
                                                            representing inherently suspect types of business, such as
                                                            work-at-home opportunities, shall not be allowed
                                                            to link); (b)the organization does not have an
                                                            unsatisfactory record with us; (c) the benefit to us from
                                                            the visibility associated with the hyperlink outweighs the
                                                            absence of InTheLink; and (d) where the
                                                            link is in the context of general resource information or is
                                                            otherwise consistent with editorial content
                                                            in a newsletter or similar product furthering the mission of
                                                            the organization.
                                                            <br>
                                                            <br>
                                                            These organizations may link to our home page, to
                                                            publications or to other Web site information so long as
                                                            the link: (a) is not in any way misleading; (b) does not
                                                            falsely imply sponsorship, endorsement or approval
                                                            of the linking party and it products or services; and (c)
                                                            fits within the context of the linking party's
                                                            site.<br>
                                                            <br>
                                                            If you are among the organizations listed in paragraph 2
                                                            above and are interested in linking to our website,
                                                            you must notify us by sending an e-mail to
                                                            inthelink2030@gmail.com.
                                                            Please include your name, your organization name, contact
                                                            information (such as a phone number and/or e-mail
                                                            address) as well as the URL of your site, a list of any URLs
                                                            from which you intend to link to our Web site,
                                                            and a list of the URL(s) on our site to which you would like
                                                            to link. Allow 2-3 weeks for a response.<br>
                                                            <br>
                                                            Approved organizations may hyperlink to our Web site as
                                                            follows:
                                                            <br>
                                                            <br>
                                                            By use of our corporate name; or
                                                            By use of the uniform resource locator (Web address) being
                                                            linked to; or
                                                            By use of any other description of our Web site or material
                                                            being linked to that makes sense within the
                                                            context and format of content on the linking party's
                                                            site.<br>
                                                            <br>
                                                            No use of InTheLink's logo or other artwork will be allowed
                                                            for linking absent a trademark license
                                                            agreement.<br>
                                                            Reservation of Rights
                                                            We reserve the right at any time and in its sole discretion
                                                            to request that you remove all links or any particular
                                                            link to our Web site. You agree to immediately remove all
                                                            links to our Web site upon such request. We also
                                                            reserve the right to amend these terms and conditions and
                                                            its linking policy at any time. By continuing
                                                            to link to our Web site, you agree to be bound to and abide
                                                            by these linking terms and conditions.<br>
                                                            Removal of links from our website
                                                            If you find any link on our Web site or any linked web site
                                                            objectionable for any reason, you may contact
                                                            us about this. We will consider requests to remove links but
                                                            will have no obligation to do so or to respond
                                                            directly to you.<br>
                                                            Whilst we endeavour to ensure that the information on this
                                                            website is correct, we do not warrant its completeness
                                                            or accuracy; nor do we commit to ensuring that the website
                                                            remains available or that the material on the
                                                            website is kept up to date.<br>
                                                            Content Liability
                                                            We shall have no responsibility or liability for any content
                                                            appearing on your Web site. You agree to indemnify
                                                            and defend us against all claims arising out of or based
                                                            upon your Website. No link(s) may appear on any
                                                            page on your Web site or within any context containing
                                                            content or materials that may be interpreted as
                                                            libelous, obscene or criminal, or which infringes, otherwise
                                                            violates, or advocates the infringement or
                                                            other violation of, any third party rights.<br>
                                                            Disclaimer
                                                            To the maximum extent permitted by applicable law, we
                                                            exclude all representations, warranties and conditions
                                                            relating to our website and the use of this website
                                                            (including, without limitation, any warranties implied by
                                                            law in respect of satisfactory quality, fitness for purpose
                                                            and/or the use of reasonable care and skill). Nothing in
                                                            this disclaimer will:<br>
                                                            <br>
                                                            limit or exclude our or your liability for death or personal
                                                            injury resulting from negligence;
                                                            limit or exclude our or your liability for fraud or
                                                            fraudulent misrepresentation;
                                                            limit any of our or your liabilities in any way that is not
                                                            permitted under applicable law; or
                                                            exclude any of our or your liabilities that may not be
                                                            excluded under applicable law.<br>
                                                            <br>
                                                            The limitations and exclusions of liability set out in this
                                                            Section and elsewhere in this disclaimer: (a)
                                                            are subject to the preceding paragraph; and (b) govern all
                                                            liabilities arising under the disclaimer or
                                                            in relation to the subject matter of this disclaimer,
                                                            including liabilities arising in contract, in tort
                                                            (including negligence) and for breach of statutory duty.
                                                            To the extent that the website and the information and
                                                            services on the website are provided free of charge,
                                                            we will not be liable for any loss or damage of any nature.
                                                        </p>

                                                        <p class="term__box-title">
                                                            Welcome to our Privacy Policy
                                                        </p>
                                                        <p class="term__box-content">
                                                            -- Your privacy is critically important to us. <br>
                                                            InTheLink is located at: InTheLink, 0867777350<br>
                                                            It is InTheLink's policy to respect your privacy regarding
                                                            any information we may collect while operating our website.<br>
                                                            This Privacy Policy applies to inthelink.net (hereinafter,
                                                            "us", "we", or "inthelink.net"). We respect your privacy and
                                                            are committed to protecting personally identifiable
                                                            information you may provide us through the Website. We have
                                                            adopted this privacy policy ("Privacy Policy") to explain
                                                            what information may be collected on our Website, how we use
                                                            this information, and under what circumstances we may
                                                            disclose the information to third parties. This Privacy
                                                            Policy applies only to information we collect through the
                                                            Website and does not apply to our collection of information
                                                            from other sources.<br>
                                                            This Privacy Policy, together with the Terms and conditions
                                                            posted on our Website, set forth the general rules and
                                                            policies governing your use of our Website. Depending on
                                                            your activities when visiting our Website, you may be
                                                            required to agree to additional terms and conditions.<br>
                                                            <br>
                                                            - Website Visitors<br>
                                                            Like most website operators, InTheLink collects
                                                            non-personally-identifying information of the sort that web
                                                            browsers and servers typically make available, such as the
                                                            browser type, language preference, referring site, and the
                                                            date and time of each visitor request. InTheLink's purpose
                                                            in collecting non-personally identifying information is to
                                                            better understand how InTheLink's visitors use its website.
                                                            From time to time, InTheLink may release
                                                            non-personally-identifying information in the aggregate,
                                                            e.g., by publishing a report on trends in the usage of its
                                                            website.<br>
                                                            InTheLink also collects potentially personally-identifying
                                                            information like Internet Protocol (IP) addresses for logged
                                                            in users and for users leaving comments on
                                                            http://inthelink.net blog posts. InTheLink only discloses
                                                            logged in user and commenter IP addresses under the same
                                                            circumstances that it uses and discloses
                                                            personally-identifying information as described below.<br>
                                                            <br>
                                                            - Gathering of Personally-Identifying Information
                                                            Certain visitors to InTheLink's websites choose to interact
                                                            with InTheLink in ways that require InTheLink to gather
                                                            personally-identifying information. The amount and type of
                                                            information that InTheLink gathers depends on the nature of
                                                            the interaction. For example, we ask visitors who sign up
                                                            for a blog at http://inthelink.net to provide a username and
                                                            email address.<br>
                                                            <br>
                                                            - Security<br>
                                                            The security of your Personal Information is important to
                                                            us, but remember that no method of transmission over the
                                                            Internet, or method of electronic storage is 100% secure.
                                                            While we strive to use commercially acceptable means to
                                                            protect your Personal Information, we cannot guarantee its
                                                            absolute security.<br>
                                                            <br>
                                                            - Advertisements<br>
                                                            Ads appearing on our website may be delivered to users by
                                                            advertising partners, who may set cookies. These cookies
                                                            allow the ad server to recognize your computer each time
                                                            they send you an online advertisement to compile information
                                                            about you or others who use your computer. This information
                                                            allows ad networks to, among other things, deliver targeted
                                                            advertisements that they believe will be of most interest to
                                                            you. This Privacy Policy covers the use of cookies by
                                                            InTheLink and does not cover the use of cookies by any
                                                            advertisers.
                                                            <br>
                                                            <br>
                                                            - Links To External Sites<br>
                                                            Our Service may contain links to external sites that are not
                                                            operated by us. If you click on a third party link, you will
                                                            be directed to that third party's site. We strongly advise
                                                            you to review the Privacy Policy and terms and conditions of
                                                            every site you visit.
                                                            We have no control over, and assume no responsibility for
                                                            the content, privacy policies or practices of any third
                                                            party sites, products or services.
                                                            <br>
                                                            <br>
                                                            - Aggregated Statistics<br>
                                                            InTheLink may collect statistics about the behavior of
                                                            visitors to its website. InTheLink may display this
                                                            information publicly or provide it to others. However,
                                                            InTheLink does not disclose your personally-identifying
                                                            information.
                                                            <br>
                                                            <br>
                                                            - Cookies<br>
                                                            To enrich and perfect your online experience, InTheLink uses
                                                            "Cookies", similar technologies and services provided by
                                                            others to display personalized content, appropriate
                                                            advertising and store your preferences on your computer.
                                                            A cookie is a string of information that a website stores on
                                                            a visitor's computer, and that the visitor's browser
                                                            provides to the website each time the visitor returns.
                                                            InTheLink uses cookies to help InTheLink identify and track
                                                            visitors, their usage of http://inthelink.net, and their
                                                            website access preferences. InTheLink visitors who do not
                                                            wish to have cookies placed on their computers should set
                                                            their browsers to refuse cookies before using InTheLink's
                                                            websites, with the drawback that certain features of
                                                            InTheLink's websites may not function properly without the
                                                            aid of cookies.<br>
                                                            By continuing to navigate our website without changing your
                                                            cookie settings, you hereby acknowledge and agree to
                                                            InTheLink's use of cookies.
                                                            <br>
                                                            <br>
                                                            Privacy Policy Changes<br>
                                                            Although most changes are likely to be minor, InTheLink may
                                                            change its Privacy Policy from time to time, and in
                                                            InTheLink's sole discretion. InTheLink encourages visitors
                                                            to frequently check this page for any changes to its Privacy
                                                            Policy. Your continued use of this site after any change in
                                                            this Privacy Policy will constitute your acceptance of such
                                                            change.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="social">
                                            <div class="term">
                                                <div class="term__agree">
                                                    <div class="custom-control custom-checkbox text-center">
                                                        <input type="text" class="d-none" name="agree">
                                                        <input type="checkbox" class="custom-control-input form-control"
                                                            required name="agree" id="agree">
                                                        <label class="custom-control-label" for="agree">
                                                            I have read the Privacy Policy and agree to the Terms of
                                                            Service
                                                        </label>
                                                        <div class=" invalid-feedback invalid-feedback-agree">Uh oh! You
                                                            haven't read the Privacy Policy and agree to the Terms of
                                                            Service</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="submit btn btn-outline-info btn-block"><i
                                                class="ft-user"></i> Register</button>
                                    </form>
                                </div>
                                <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1">
                                    <span>You already have account?</span></p>
                                <div class="card-body">
                                    <a href="{{ route('login') }}" class="btn btn-outline-danger btn-block"><i
                                            class="ft-unlock"></i> Login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>

@stop
@section('scripts')
<script>
    $(document).ready(function(){
        generateDateSelectbox();
        //show modal notice when redirect to page
        if($('input[name="is_redirect"]').val()){
            $('#modalSigninNotice').modal('show');
            localStorage.setItem('is_redirect',true);
        }
        
        let self = this;
        //button add new social fields
        $('.btn-add-social').on('click',function(e){
            e.preventDefault();
            if($('.social-influencer').find('.social-group').last().find('input').val() != ''){
                $(`<fieldset class="form-group position-relative has-icon-left social-group">
                    <input class="form-control" type="text" name="social[]" required="" placeholder="https://abcxyz.xxx">
                    <div class="invalid-feedback text-center">
                        Please fill your social account(s)
                    </div>
                    <div class="form-control-position">
                        <i class="ft-share-2"></i>
                    </div>
                    <div class="form-control-position btn-remove-social">
                        <i class="ft-x"></i>
                    </div>
                </fieldset>`).insertAfter($('.social-influencer').find('.social-group').last());
            }
        });
        
        //button remove social fields
        $('body').on('click','.btn-remove-social',function(e){
            $(this).closest('fieldset').remove();
        });
    });
</script>
@stop