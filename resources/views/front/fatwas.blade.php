@include('front.includes.header')
    <!--Start Content-->
    <main
      class="main-content"
      style="background-image: url(front/assets/images/background.png)"
    >
      <div class="container">
        <div class="fatwas">

          <div class="maintitle">
            <h1>الفتاوى</h1>
          </div>
          <div class="questions" src="{{URL::asset('front/assets/images/background.png')}}">
            @foreach($rules as $r)
            <qa-modal
              shown-question="{{$r->question}} "
            >
              <p slot="q">
                {{$r->questionDetails}}
              </p>
              <p slot="a">
                {{$r->answer}}
              </p>
            </qa-modal>
            @endforeach
            
          </div>
          <div class="fatwas-contact-form">
            <div class="maintitle">
              <h1>اطرح سؤالك</h1>
            </div>
            <form action="">
              <div class="form-field">
                <label for="subject">موضوع الفتوى :</label>
                <input
                  id="subject"
                  name="subject"
                  type="text"
                  placeholder="اكتب موضوع فتوتك هنا"
                />
              </div>
              <div class="form-field">
                <label for="name">اسم الراسل :</label>
                <input
                  id="name"
                  name="name"
                  type="text"
                  placeholder="اكتب اسمك هنا"
                />
              </div>
              <div class="form-field">
                <label for="email">البريد الالكترونى :</label>
                <input
                  id="email"
                  name="email"
                  type="email"
                  placeholder="اكتب عنوان بريدك الالكترونى هنا"
                />
              </div>
              <div class="form-field">
                <label for="message">الفتوى :</label>
                <textarea
                  name="message"
                  id="message"
                  placeholder="اكتب محتوى فتوتك هنا"
                ></textarea>
              </div>
              <button type="submit">ارسال</button>
            </form>
          </div>
        </div>
      </div>
      @include('front.includes.footer')