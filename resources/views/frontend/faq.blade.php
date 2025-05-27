
@extends('frontend.layout.layout')



@section('content')
    <style>
   
        h1 {
            color: #333;
            font-size: 2.5rem;
            margin-bottom: 40px;
        }

        .accordion-button {
            background-color: transparent !important;
            /* Make background fully transparent */
            border: none !important;
            /* Remove border */
            padding: 15px;
            font-weight: bold;
            font-size: 16px;
            color: #333;
            text-align: left;
            transition: background-color 0.3s ease, border 0.3s ease;
        }

        .accordion-button:focus {
            box-shadow: none !important;
            /* Remove focus shadow */
            outline: none !important;
            /* Remove outline on focus */
        }

        .accordion-button:hover {
            background-color: transparent !important;
            /* Remove background color on hover */
        }

        .accordion-button.collapsed {
            background-color: transparent !important;
            /* Keep background transparent when collapsed */
            border-bottom: none !important;
            /* Remove the border line under the question */
        }

        .accordion-body {
            background-color: transparent !important;
            /* Make the body fully transparent */
            font-size: 14px;
            padding: 15px;
            color: #333;
            border-top: none !important;
            /* Remove top border */
        }

        .accordion-item {
            border: none !important;
            /* Remove border around each accordion item */
        }

        .search-bar {
            margin-bottom: 30px;
        }

        p {
            margin-bottom: -5px;
        }

        @media (max-width: 767px) {
    .accordion-button {
        font-size: 14px;
    }

    .accordion-body {
        font-size: 12px;
        padding: 10px;
    }
    
    .search-bar {
        margin-bottom: 15px;
    }
}

    </style>

        <div class="container my-5" ">
            <h1 class="text-center mb-4" style="margin-top:180px">Frequently Asked Questions</h1>


            <div class="search-bar">
                <input type="text" class="form-control" id="searchInput" placeholder="Search for a question...">
            </div>

            <!-- FAQ Section -->
            <div class="accordion" id="faqAccordion">
                <!-- FAQ Item 1 -->
                @foreach ($faqs as $index => $faq)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $index }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse{{ $index }}" aria-expanded="false"
                                aria-controls="collapse{{ $index }}">
                                {{ $faq->question }}
                            </button>

                        </h2>
                        <div id="collapse{{ $index }}" class="accordion-collapse collapse"
                            aria-labelledby="heading{{ $index }}" data-bs-parent="#faqAccordion">
                            <div class="accordion-body w-100">
                                <div class="col-lg-12 col-md-12 col-sm-12" >
                                        <?= $faq->answer ?>

                                </div>
                            </div>
                        </div>
                        <hr style=" display: block; margin: 7px auto 0; border-top: 1px solid #444444;">
                    </div>
                @endforeach


            </div>



        </div>

        <script>
            // Search functionality for FAQ section
            document.getElementById('searchInput').addEventListener('input', function(e) {
                const query = e.target.value.toLowerCase();
                const faqItems = document.querySelectorAll('.accordion-item');

                faqItems.forEach(item => {
                    const question = item.querySelector('.accordion-button').textContent.toLowerCase();
                    if (question.includes(query)) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        </script>





    @endsection
