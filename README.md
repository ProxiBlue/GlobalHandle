GlobalHandle
============

Adds a new Global Handle to layouts to override anything as a final layout directive

Magento's default layout loading order is as such:

 default
 STORE_bare_us
 THEME_frontend_default_default
 helloworld_index_index
 customer_logged_out

The issue is that there is no 'last' global layout handle that allows you to make a change to any previous layout directive.<br/>
An example of such a requirement is to have the ability to globally change all the root templates<br/>

This module simply injects a new layout handle as the last layout handle called 

 <GLOBAL_OVERRIDE>

Using this, it is, for example possible to override all page layouts to one base template, as apart from having to refer to eache handle seperately.

    <GLOBAL_OVERRIDE>
        <reference name="root">
            <action method="setTemplate"><template>page/3columns.phtml</template></action>
            <action method="setIsHandle"><applied>1</applied></action>
        </reference>
    </GLOBAL_OVERRIDE>


This then effectively makes the entire site 2columns-left, and no page is accidentally missed, and display in the wrong column structure.