fostrest-article-api
====================

To install friendsofsymfony :

composer require friendsofsymfony/rest-bundle

composer require jms/serializer-bundle
or use serializer. delete commentary into config.yml ....

add AppKernel :
new JMS\SerializerBundle\JMSSerializerBundle(),

add config.yml :

fos_rest:
    view:
        formats: { json: true, xml:false, rss: false }
    serializer:
        serializer_null: true
    body_converter:
        enabled: true
        
you can choose other options in the doc.

you can find options fostrest:

bin/console config:dump-reference fos_rest



A Symfony project created on May 22, 2018, 4:36 pm.
