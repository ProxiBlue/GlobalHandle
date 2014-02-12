GlobalHandle
============

Adds a new Global Handle to layouts to override anything as a final layout directive

<br/>Magento's default layout loading order is as such:
<br/>
default<br/>
STORE_bare_us<br/>
THEME_frontend_default_default<br/>
helloworld_index_index<br/>
customer_logged_out<br/>
<br/>

The issue is that there is no 'last' global layout handle that allows you to make a chnage to any previous layout directive.<br/>
An example of such a requirement is to have the ability to globally change all the root templates<br/>

This module simply injects a new layout handle as the last layout handle called <GLOBAL_OVERRIDE>

<br/>

Using this, it is, for example possible to override all page layouts to one base template, as apart from having to refer to eache handle seperately.

    <GLOBAL_OVERRIDE>
        <reference name="root">
            <action method="setTemplate"><template>page/3columns.phtml</template></action>
            <action method="setIsHandle"><applied>1</applied></action>
        </reference>
    </GLOBAL_OVERRIDE>
