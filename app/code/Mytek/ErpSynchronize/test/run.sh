# !/bin/bash 

# access token : yhzp2qahgfvk1o3i7rb4irjy3x9e9d59
# Access Token Secret : iiskksib6hz33ivfdslfxgx6ugsad23s


#### prod token 
# Access Token: 4lgw95h2o5v1bkcgcb7mfd3mdlro824b
# Access Token Secret: asrqpgnllrh24iifktpv2siyj0gxf5ax


ACCESS_TOKEN="jkg4h6t8spk8nw8u6bcc5x3cuqs5ca2z" # horsprod
# ACCESS_TOKEN="4lgw95h2o5v1bkcgcb7mfd3mdlro824b" # prod

# URL_STORE="https://www.mytek.tn" # prod
URL_STORE="https://test123.mytek.tn" # dev



# Get 
# curl -k -H 'Accept: application/json' -H "Authorization: Bearer ${ACCESS_TOKEN}"  "${URL_STORE}/rest/V1/products/${SKU}"

# Get helloworld api 
# curl -k  -H 'Accept: application/json' -H "Authorization: Bearer ${ACCESS_TOKEN}" "${URL_STORE}/rest/V1/mageplaza-helloworld/post?param=toto"

# Post 

# curl -X POST -d @data.xml -k   --header "Content-Type:text/xml;charset=UTF-8" -H "Authorization: Bearer ${ACCESS_TOKEN}"  "${URL_STORE}/rest/V1/mageplaza-helloworld/post"


# test add stock  webservice : 

# curl -k -v  -X POST  -H "Authorization: Bearer ${ACCESS_TOKEN}" \
#  -H 'Content-Type: application/json' \
#  -d @divalto.json \
#    "${URL_STORE}/rest/all/V1/stock_syncronize"



# get list stock 






#upload multiple stock item

# curl -k -v  -X POST  -H "Authorization: Bearer ${ACCESS_TOKEN}" \
#  -H 'Content-Type: application/json' \
#  -d @divalto_multi.json \
#    "${URL_STORE}/rest/all/V1/stock_syncronize_multi"



#upload multiple refactor stock item

curl  -v \
      -X POST \
      -H "Authorization: Bearer ${ACCESS_TOKEN}" \
      -H "Content-Type: application/json" \
      -d @multi_refactor.json \
         "${URL_STORE}/rest/V1/stock_syncronize" # |jq .





# curl -k   \
#  -H 'Content-Type: application/json' \
#    "${URL_STORE}/rest/all/V1/stock_syncronize?criteria%5BpageSize%5D=10"
