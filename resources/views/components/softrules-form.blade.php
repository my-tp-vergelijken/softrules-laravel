<div>
    <form id='userinterfaceForm'
          method='POST'
          style="padding: 15px;">
        @csrf

        {{ \SoftRules\Laravel\Facades\SoftRules::renderXml($xml) }}
    </form>

    <script>
        const config = {
            product: @js($product),
            initialXml: @js(trim($xml->saveHTML($xml->documentElement))),
            routes: {
                renderXml: @js(route('softrules.render-xml')),
                updateUserInterface: @js(route('softrules.update-user-interface')),
                previousPage: @js(route('softrules.previous-page')),
                nextPage: @js(route('softrules.next-page')),
            },
        };
    </script>
</div>
