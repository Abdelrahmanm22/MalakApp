@include('front.includes.header')
    <!--Start Content-->
    <main
      class="main-content"
      style="background-image: url(front/assets/images/background.png)"
    >
      <div class="container">
        <div class="videos-books">
          <div class="maintitle">
            <h1>الكتب المسجلة مرئيًا</h1>
          </div>
          <div class="books">
            
            @foreach($myBooks as $b)
              <div class="book">
                <a href="{{url('sectionsVideo/'.$b->book_id)}}">
                  <div class="book-cover">
                    <img
                      src="{{URL::asset('files/books/'.$b->image)}}"
                      alt="صحيح البخارى"
                    />
                  </div>
                  <p class="name">{{$b->name}} </p>
                  <p class="description">
                    {{$b->type}}
                  </p>
                </a>
              </div>
            @endforeach
            <!-- <div class="book">
              <a href="./video-book-sections.html">
                <div class="book-cover">
                  <img
                    src="{{URL::asset('front/assets/books cover/download.jpeg')}}"
                    alt="صحيح البخارى"
                  />
                </div>
                <p class="name">صحيح البخاري</p>
                <p class="description">
                  الجامع المسند الصحيح المختصر من أُمور رسول الله صلى الله عليه
                  وسلّم وسننه وأيامه
                </p>
              </a>
            </div>
            <div class="book">
              <a href="./video-book-sections.html">
                <div class="book-cover">
                  <img
                    src="{{URL::asset('front/assets/books cover/download.jpeg')}}"
                    alt="صحيح البخارى"
                  />
                </div>
                <p class="name">صحيح البخاري</p>
                <p class="description">
                  الجامع المسند الصحيح المختصر من أُمور رسول الله صلى الله عليه
                  وسلّم وسننه وأيامه
                </p>
              </a>
            </div>
            <div class="book">
              <a href="./video-book-sections.html">
                <div class="book-cover">
                  <img
                    src="./assets/books cover/download.jpeg"
                    alt="صحيح البخارى"
                  />
                </div>
                <p class="name">صحيح البخاري</p>
                <p class="description">
                  الجامع المسند الصحيح المختصر من أُمور رسول الله صلى الله عليه
                  وسلّم وسننه وأيامه
                </p>
              </a>
            </div> -->
          </div>
        </div>
        <div class="contact-form">
          <div class="maintitle">
            <h1>تواصل مع فضيلة الشيخ</h1>
          </div>
          <form action="{{route('postContact')}}" method="post">
            @csrf
            <div class="form-field">
              <label for="name">اسم الراسل :</label>
              <input
                id="name"
                name="name"
                type="text"
                placeholder="اكتب اسمك هنا"
              />
              @error('name')
                <small class="form-txt text-warning">{{$message}}</small>
              @enderror
            </div>
            <div class="form-field">
              <label for="email">البريد الاكترونى للراسل :</label>
              <input
                id="email"
                name="email"
                type="email"
                placeholder="اكتب عنوان بريدك الالكترونى هنا"
              />
              @error('email')
                <small class="form-txt text-warning">{{$message}}</small>
              @enderror
            </div>
            <div class="form-field">
              <label for="phone-number">رقم هاتف الراسل :</label>
              <input
                id="phone-number"
                name="phone"
                type="tel"
                placeholder="اكتب رقم هاتفك هنا"
              />
              @error('phone')
                <small class="form-txt text-warning">{{$message}}</small>
              @enderror
            </div>
            <div class="form-field">
              <label for="message">ما رسالتك لفضيلة الشيخ :</label>
              <textarea
                name="message"
                id="message"
                placeholder="اكتب رسالتك هنا"
              ></textarea>
              @error('message')
                <small class="form-txt text-warning">{{$message}}</small>
              @enderror
            </div>
            <button type="submit">ارسال</button>
          </form>
        </div>
      </div>
@include('front.includes.footer')