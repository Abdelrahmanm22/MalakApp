@include('front.includes.header')
<!--Start Content-->
<main
      class="main-content"
      style="background-image: url(/front/assets/images/background.png)"
    >
      <div class="container">
        <div class="fatwas">
          <div class="maintitle">
            <h1>الفتاوى</h1>
          </div>
          <div class="questions" src="{{URL::asset('front/assets/images/background.png')}}">
            <div id="fat-dropdown">
              <ul class="main">
                <li>
                  <details open>
                    <summary></summary>
                    <ul>
                      @foreach($sections as $s)
                      <li>
                        <dropdown-tree name="{{$s->name}}">
                          <ul>
                          @foreach($rules as $r)
                            <li>
                              @if($r->section_id==$s->id)
                              <qa-modal
                                shown-question="{{$r->question}}"
                              >
                                <p slot="q">
                                  {{$r->questionDetails}}
                                </p>
                                <p slot="a">{{$r->answer}}</p>
                              </qa-modal>
                              @endif
                            </li>
                          @endforeach
                          </ul>
                        </dropdown-tree>
                      </li>
                      @endforeach
                      
                    </ul>
                  </details>
                </li>
              </ul>
            </div>
          </div>
          <div class="fatwas-contact-form">
            <div class="maintitle">
              <h1>اطرح سؤالك</h1>
            </div>
            <form action="{{route('postQuestion')}}" method="post">
              @csrf
              <div class="form-field">
                <label for="subject">موضوع الفتوى :</label>
                <input
                  id="subject"
                  name="topic"
                  type="text"
                  placeholder="اكتب موضوع فتوتك هنا"
                />
                @error('topic')
                <small class="form-txt text-danger">{{$message}}</small>
                @enderror
              </div>
              <div class="form-field">
                <label for="name">اسم الراسل :</label>
                <input
                  id="name"
                  name="sender"
                  type="text"
                  placeholder="اكتب اسمك هنا"
                />
                @error('sender')
                <small class="form-txt text-danger">{{$message}}</small>
                @enderror
              </div>
              <div class="form-field">
                <label for="email">البريد الالكترونى :</label>
                <input
                  id="email"
                  name="email"
                  type="email"
                  placeholder="اكتب عنوان بريدك الالكترونى هنا"
                />
                @error('email')
                <small class="form-txt text-danger">{{$message}}</small>
                @enderror
              </div>
              <div class="form-field">
                <label for="message">الفتوى :</label>
                <textarea
                  name="question"
                  id="message"
                  placeholder="اكتب محتوى فتوتك هنا"
                ></textarea>
                @error('question')
                <small class="form-txt text-danger">{{$message}}</small>
                @enderror
              </div>
              <button type="submit">ارسال</button>
            </form>
          </div>
        </div>
      </div>
      @include('front.includes.footer')