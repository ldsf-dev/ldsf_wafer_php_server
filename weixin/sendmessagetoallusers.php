<?php

require "http_request.php"; 
require "get_access_token.php"; 

$token = getAccessToken(); 

$data = '{
   "touser":[
   "oXXigwt6qxXY5koCHTG6DlY5YaR8",
"oXXigwoTWaH57NGztuvgSkI362A8",
"oXXigwrG7GsbSPG8vEhia_Dfurlk",
"oXXigwgZc7zWbWohvke5tjTfW5CE",
"oXXigwgNW7uVCmHr3t-uZculiVKk",
"oXXigws6GrHpqs7xyDPISRnxiOEk",
"oXXigwtMvT_EyUcVJ6_-aYWeNlq0",
"oXXigwmyJ8-aLrSsy8rHorKUfKZo",
"oXXigwkG76CThaRehjPSpGJ3XEKs",
"oXXigwhIrVSdsmZWEn6d2tnGSkL8",
"oXXigwsnlxzmk7zXfNthTrlgIYfE",
"oXXigwrJ5OHJFQe6qy_bWlBpqS9Q",
"oXXigwrjfhZPONq7G36V_--ZEF5Y",
"oXXigwgnK8gKdxAHhwW0Tew4xYEE",
"oXXigwnT_evOD-nQK4lgSogiIPY0",
"oXXigwolhVlI1fAvxJSjThKoMkl8",
"oXXigwuusp_QanWyaNC_qNE6Np64",
"oXXigwnozgV0Lf6jO1-BnXuFlHoo",
"oXXigwtUTnjxSDpK0BTv7dGmMoj4",
"oXXigwnPddQramTz2g-nkve4EeoY",
"oXXigwjm5TBjrLf65iMQYFJhatT8",
"oXXigwm2opKUPFcowg8_jdp2NqMs",
"oXXigwr0CKJ-bPuZ0twUK5bq6Keo",
"oXXigwpGwnEpsb2XqgcbJI0VwUoc",
"oXXigwqUImAvC17vlPN6rrwpvQAc",
"oXXigwqep-TP1sWYNNtGYmOHRJKk",
"oXXigwqI3VRg4cDVN5AoWufnKQjw",
"oXXigwgVWR7VWH9jcIADKNMEQKzw",
"oXXigwvO-Lw4Dm1K4XSExYWV5A48",
"oXXigwl7jRbj8xIW30_WEJC5WgH0",
"oXXigwqyyKGgUiNMFnV13KrQoGbY",
"oXXigwlP6oUHsY71gCsWCsXNimkY",
"oXXigwr-9zG9ZwH0xMSBOEYFm9bA",
"oXXigwnBOkkFf32dlaDk-S-bAaYA",
"oXXigwlVb8RI8eGowg00QyYx4MwQ",
"oXXigwgFzTWiLmOez6k0rwbmnjv8",
"oXXigwqERyAlQiqzZ4CO8xAIHYcY",
"oXXigwuC-xrRqDEXhDTrKePQt9_I",
"oXXigwnaHDoRtJSJT_qmyX4Qbu1I",
"oXXigwmaCVfbMIIs_4K4HHwia5dY",
"oXXigwp4FmR0D6IaujYZkIGUdJlk",
"oXXigwut-NLqTIhJv7jLFJzEvT8g",
"oXXigwiZ1FpUkqTjWdIhC85O2l58",
"oXXigwqgE2IyvyPgiAIJbwAwSX7U",
"oXXigwomjU_86wRGS_CjIR0R696o",
"oXXigwoswnqZkFvx0KaIlwRQm8Ec",
"oXXigwrj-o-fFtUvCqKgi6IfMVxw",
"oXXigwrgyXIVWFoOyVn0ZK_608og",
"oXXigwhQ4-IqE1ckaJFphxxxubSc",
"oXXigwolOHSFvlM4IF4WHkXXACn0",
"oXXigwvpPmSxGDF8odkhpDu5uAmg",
"oXXigwk6xQp3aKGjbZfSHVc4lLpw",
"oXXigwh_Oa9VG0_sXRP7zws-icyo",
"oXXigwqd7KQ7NKVlrNyymSCPI5EU",
"oXXigwrd2s3eHY50c40owH4tMcGc",
"oXXigwrjF1qD56L_YyPrUwZm1hSU",
"oXXigwkaqcQfw6HcgwcSEg6VIepI",
"oXXigwnOM6iWgPO39FGNKdeL2cFU",
"oXXigwqcidwMKVkNeRWqtzSnPdUg",
"oXXigwvzR-_42YWwFv4--3BBi8OA",
"oXXigwh9r_DJAAn9zznpwgdWUFN8",
"oXXigwvSyXTf1rgN29kjXCDjnpOc",
"oXXigwnrGJXOS-QnqRtzi1Kq0EMI",
"oXXigwur8BwOHvqkwJmCM6JGSrt4",
"oXXigwqRkZtKjQZtcKZbCsY01X5E",
"oXXigwqQvNSLSxy_4E5JIOoQgF6Q",
"oXXigwqXxrL_8hzuPqJbv8MxW5po",
"oXXigwrPoSKyz9YKe0WtdoJJSzJ0",
"oXXigwshO3F9LmWvv55YPBA_COsM",
"oXXigwjApb20JichzLtmWSRjd9js",
"oXXigwie8AmkPoqIpbtptM8CW06g",
"oXXigwvEw040jdAlQ6iFah9CdJRw",
"oXXigwjCIM8JN7acKsCrZddk8H8U",
"oXXigwp2fO7Y5RBR5ml7M0fP7BLE",
"oXXigwmgELzUkWNMSnKfQW7zDr28",
"oXXigwjyqov0K6ZmohnZUWXqx4sY",
"oXXigwqNcdKlf7IwEFE-ux3xTQ3Y",
"oXXigwhuQA05SwB9NMwh8FZHgouA",
"oXXigwmOxSB2LjF1fZHvPwpJY0EI",
"oXXigwkI0hd8njMrUAm6WSnd4njM",
"oXXigwjow3chtP13wkXTAi8MKklI",
"oXXigwvDQ_K-MDp8w9gGa2p5YYZc",
"oXXigwhTHYCtGSyFEH7Je7frrMb8",
"oXXigwubE4g691KphJ-mt8aakhWI",
"oXXigwmd7uQlwKmfOTaDpKHcIrik",
"oXXigwmvu8KWgGStICxq50kI7ZvE",
"oXXigwn29clOLWYftLux1ay96b6E",
"oXXigwqQNbWJNEmpwa9V1sTClTIE",
"oXXigwlnnUyx7GIQ621gc_5cH6_A",
"oXXigwq2V3YyhHqkRfnFRbLXwSZI",
"oXXigwiGqNCXTvsiv6_4hqPuqbwY",
"oXXigwph_TfqZUOUxhzc9UuamaW8",
"oXXigwgSpG1rTenDbXj0KqApmlBE",
"oXXigwtf8zNndTbgAGocX-laFcQk",
"oXXigwuCL6HpBK_cHTwow2oN8Zng",
"oXXigwgq8Hk_Pp1bdaLKV6vdIeuo",
"oXXigwg76MeLzWzVkz28JQDd93so",
"oXXigwkSaZojdaIJEw4G-Uwo91Zo",
"oXXigwnwwtmXSUR1uEZcDlgONB-U",
"oXXigwkdPtuIcIdwVDra1TWUopL8",
"oXXigwpW8omLdjbPPNCZZmWZFyyY",
"oXXigwmYZU0EDdSY147mnqQDJx6w",
"oXXigwvL5NWCWxjY13_4eqOfrx0o",
"oXXigwgmGi2Ucusxf8MjmMpv4Ox8",
"oXXigwir6mlEGAY1ndga-efrDhZQ",
"oXXigws4gNtk8Mdte4PbgfIGArHo",
"oXXigwm8x8xDiNVwFv78YptmRMHg",
"oXXigwnvj8dRMrppp-WeMwJMjb9s",
"oXXigwhRcrxjDp0AoIWAUo0QtfbY",
"oXXigwu30kwr-gHBeK8SHU6_uNPw",
"oXXigwh0UdtnFk9FyNJUlRqPsv1I",
"oXXigwqksC8MvY4Ez-Mat49ijbFQ",
"oXXigwp6qD9uyFZmxqVMZHvDKcAc",
"oXXigwjbmq78tzMV_sPpo938Y388",
"oXXigwmtBVKnebOSE-lBsucLcdbI",
"oXXigwsFK3qPoL2pqxgOYlPZh-3s",
"oXXigwotwHEoMOz5eNj2ePVE_9o8",
"oXXigwu0CsbOVyEWJEB6co4uPILs",
"oXXigwhL-i32Yx-C_WQhaOpXqw9o",
"oXXigwqwVg66vzGuLlbmCurFWODA",
"oXXigwkzknA5xkgoV35P-j6mRLaI",
"oXXigwo_hmLBuGx-mgatv1nBhf8A",
"oXXigwoAYEiegb2v1mLjtN1Azb90",
"oXXigwtmcaeP4fN3NQDcEwsOWBls",
"oXXigwsLkMICuxnCgH2tm3oSNID4",
"oXXigwgcEOmiKbsERPd9kYdgmr-w",
"oXXigwtswj_sA8EpeVicnqDHQ3N4",
"oXXigwqlD4L5TbNxntjeIqWCW2eg",
"oXXigwmUkdgNOcEE-FZrpDak8Vjs",
"oXXigwrPZ8r7fSuYmpWZQFcC4vng",
"oXXigwkeQ7DWyvPbg4F1Ou_W9cA4",
"oXXigwqoiemkg55aaidYqjKvxt0I",
"oXXigwrjfg32XAJKNcajP2SnwPNA",
"oXXigwu4fcsRuD_H6myld1D8-xH0",
"oXXigwq2piewyq-IZloPEZWAkT88",
"oXXigwmkSlbDCbEDvYDEBjfx-d6w",
"oXXigwgwUxloqL72g2moihZ3qJSA",
"oXXigwnRCy7BjbmViSfkkN0gwTSA",
"oXXigwmq4IyvJxBS-clmRlBhS_Sk",
"oXXigwokoapXO5FgC2nKCjTuofms",
"oXXigws8OwTJlE7JbfU_FMcQAxIQ",
"oXXigwqPk5rIKDSqA90KfXEVKr_I",
"oXXigwjvGHuhWXWQXAMfFxaT_jbU",
"oXXigwksJZje3YpasNVqKh9CxNf4",
"oXXigwnxNZJ4BmvYA8R_Twt7ZTgk",
"oXXigwr9mDcuTcfmpTLZazibot4E",
"oXXigwu4u1czfWOgA-mXWyGHSWzA",
"oXXigwoa5fpNgqc9Zchw5mZbSr1k",
"oXXigwlUIDn3mCJ94_9dDZg8fPew",
"oXXigwgkHn8twXClzI2Ul-ELktbg",
"oXXigwvWkqMbb46vRnppsQU9TyKg",
"oXXigwg6pbFSLpvSOu7BWjSKFZFU",
"oXXigwm2IHdhLwUWyQnqoI1QNukw",
"oXXigwoOxxcUThKdyGCkDAN6EBsw",
"oXXigwh4d8VPP0pCW2xlsL7bCEmU",
"oXXigwlKVDNcummlCXdEeFHvZzBw",
"oXXigwr0e35jCMBgWCxRW6-Ce9ZQ",
"oXXigwgUwP9m3acc1-End4GYKVKE",
"oXXigwqrYiBP1Q7DWVRKzNX632Tw",
"oXXigwkXRdiOTbZy4PY_VekPQCn4",
"oXXigwmPF32_0RYrBqX5cYyOgZ6E",
"oXXigwhJOqlKx5y4HfD2ol-E1Tfs",
"oXXigwmQPT6lkTd9ZK1OOZ3K0Q3U",
"oXXigwjy3E3DZSY1FHiYKp8z8Jw4",
"oXXigworzLKU56biIETalSXKMZEA",
"oXXigwhhLg8nEbY6TJezUwSLwqy0",
"oXXigwhO64W7m7JBOyVNT65XDmPo",
"oXXigwj2MnGSlgyVUXcAmCmWfFF0",
"oXXigwgFwY1vGeoJNbT7ymcR53Js",
"oXXigwmRlEHgfa0KgOguT_dpbafs",
"oXXigwiQyMZl82pGoLt2zxurA5iU",
"oXXigwoBw1lDpjzIyXRs9sHoqkAw",
"oXXigwjI-ExQhdbgKr0U15iFfuQs",
"oXXigwu1Q0mpp-BITKZel2Fjf-8o",
"oXXigwsumcLj641Hy6i3fDf5yZJk",
"oXXigwrUnu_ZmIpj5S8K_i-k-GkI",
"oXXigwigRkWid-p8eDPOJshkAKEI",
"oXXigwodX859WFL3LWBl8qMAQSkA",
"oXXigwjSRSOFX_w8AnM76_33cphk",
"oXXigwsL99Xbo2_0_SxUZ2jv5hQE",
"oXXigws0vRaxZIiZtaC0ccyJiuU0",
"oXXigwhX0zKs1cK0HImqh-mugPq4",
"oXXigwuoui5D_naB-exktO1eIaDI",
"oXXigwtq_lJXrqrS8MCO1jHaa89A",
"oXXigwpd2UGb702nkpJEIY5xCDtU",
"oXXigwv7768CbHI1-S3NDeKUGWQw",
"oXXigwufqPH47x6YJjiqols1T8Ss",
"oXXigwsa5jKgmMR_DR4RECWJk34c",
"oXXigwlr4rZ3pN3JnARn52VUVeQw",
"oXXigwmgClBqZcvi04iiNbaqXjXY",
"oXXigwhscaM7ujsw9vm3zx2JGC0o",
"oXXigwm43IoKPdRXjr7D8bG5HXQ0",
"oXXigwtxxBWwfT3GcRvYML1AAKg0",
"oXXigws3meZ2vgiLiCzzC33uHwIo",
"oXXigwhPuZJfktCoLi4KNBP48XLU",
"oXXigwsOSaLZY1uF-xFUnXbaH1bA",
"oXXigwlQWUOxAEeQTr_xrdoWoJR8",
"oXXigwnzbWZNep6gUNePocS6T0SE",
"oXXigwmnvj8JEch8YBMAiK_8Mbd8",
"oXXigwuq0__mfMiTk4Sl2qy2zkmA",
"oXXigwvTRjKXw8G2msjBxm6vgo7I",
"oXXigwgbqDNGwhgveBjE8TePPXHg",
"oXXigwlZ5Ht92oWWy4mxczM29ek8",
"oXXigwpRh1E1SwTG9oz6VZIwnDcI",
"oXXigwtFz4BzBSPQDajwbVbPD_Dw",
"oXXigwqC2PPuINbaa2Uc8tnSK-JY",
"oXXigwufS709sHM_mki9zDIwrhRs",
"oXXigwoNhAVnF5TyLOFPNghJKZwY",
"oXXigwja_HnGmNmR3SxnJMzcNcv8",
"oXXigwgR_TuZFlMzOcADy1SgdJA0",
"oXXigwur184EHArMLCNqzVA4SC_o",
"oXXigwrTQfNyExczJmrjqGLqrMEw",
"oXXigwpcwHcIVcYtMQOBmEglxYCY",
"oXXigwjVW1eLwUl-GcaubYfh469U",
"oXXigwvWCvFXLCsC1TO6gBecbCDM",
"oXXigwg3ZP--4UbMiAT3913Enwpo",
"oXXigwr3wc0xXNSn1r3DuDabppyk",
"oXXigwjlCJvfaHoUd7QHc7v_zVng",
"oXXigwvVdLW4EsMGhlQkgyss9Lew",
"oXXigwgj0_JsX6QTimGbJzIrgZLo",
"oXXigwjkdCngKmGDVf2Vb4GlIXTw",
"oXXigwnoYxfo8iNsXX8ttRgkVeEo",
"oXXigwtvtXxPp-krBFn_gmj0ez6s",
"oXXigwragLMhVVT-pBYKHDyXhNYc",
"oXXigwpxYH4EvAWxj599SdIC2nfU",
"oXXigwvB8M379qTAlyekBQdKjC5k",
"oXXigwirSl3MbDEBljwlC7h92QpA",
"oXXigwvRDd-_n9fFuNS5Y_iv3V04",
"oXXigwtx9xK47WzKDuPDHtAS7Vyw",
"oXXigwpOMg0dYJlQB0QC-ie5jstA",
"oXXigwj8FK_xbtjhE2hB1ute0qQE",
"oXXigwkGroxxQf-Kg0TENAMarG8Y",
"oXXigwg2YXkcMnKSntUANzok9RuI",
"oXXigwmF_kgYKklgd1NIKpPaa5IQ",
"oXXigwqLOmWuh6dXWkv0ryH1nCq8",
"oXXigwoYzlOMUH3sL6rSkQknQUNQ",
"oXXigwinaeQqOv5-1jp2p3MxOm_o",
"oXXigwg3Eo2y51BpbrCKZy3jZ4QQ",
"oXXigwpkpSRE_ODX-4UsbXiA3zaE",
"oXXigwhoIhGOxapxHEOCV7mWOoSc",
"oXXigwurY4NjKyQTuoBMSDSgfApE",
"oXXigwqLlX8hehT70ad4XXJDqV5o",
"oXXigwkgViyiU5xMklle30Me-ZTI",
"oXXigwq4I_FgANxFYykiIz8CuQ4E",
"oXXigwm-X0Dej9NFY1NuzN9AdyY0",
"oXXigwp7s1a5vDvl6P_Gf_3v0UmI",
"oXXigwuT0TeQ3i4U8yyV2ZINMTG4",
"oXXigwh_bSZpcGzw8j2M8_qIt4Pw",
"oXXigwtHphddNsvLKqqXxEwmKjc0",
"oXXigwi8jqzz_kD8P3LnPmu8z0oE",
"oXXigwvCI7N55Jw8e3AONxGbA4I8",
"oXXigwvBMws1Matoo7Q0dYo59k8Q",
"oXXigwinkVFdluW0DlfxkFtgt4eA",
"oXXigwntWr9zJbXhjZKHrTqi2dCY",
"oXXigwqrkDkRjJy5wwCuue7rnDoY",
"oXXigwuUKClsertvSVdXXe-4G-aY",
"oXXigwuJJwroSwnYUeovOSY39d50",
"oXXigwnpK3fyeNt0PGZaQbmrAK1Q",
"oXXigwlsJQ_9IdIPm50Rght5kDwQ",
"oXXigwod8FKzZshkyyd9XIuiseuU",
"oXXigwhxxUoo1HEjt9WGbMdlCPck",
"oXXigwjUkUP0_fn5XAXe3ABPtXhk",
"oXXigwg2kZnyadPlXLpxUiUKeSZA",
"oXXigwqH2zQvHX5PVYEqVuunosY8",
"oXXigwlHSOjTdcyE4lmlp-8_iLQY",
"oXXigwp8Lc3Ik8yTDNFX8qqcPPpE",
"oXXigwgBhkhAt99m2eMuLq1OuwiE",
"oXXigwir8RjRAhownBCMSKHIyQQs",
"oXXigwqBzROQ9-n8IUSCl-IHmnbI",
"oXXigwmlttWi3aUaqSi29MBgQoPc",
"oXXigwoC-AnAof6QGNodJ91zZCAo",
"oXXigwvD_u5RGHTmM62wD5l_ZZRs",
"oXXigwtPF0YoJmSgrb7SjsyoSVWM",
"oXXigwosXcFnJHo6SvOYtBQLgUf4",
"oXXigwkD7VYAhdGsZLs7T6VZoSHw",
"oXXigwg6Ybr_xWs3Z0MwYcIFLUUI",
"oXXigwjvEhWXuKqfuvvqqIP-nbZ4",
"oXXigwrHfJoWcndamYDYVo3nzS24",
"oXXigwnbGo8etxXwZhLh4O306-jA",
"oXXigws-5Xbx2plB2QYr6G1yGzZY",
"oXXigwg4OgmdpnM53qXxyuMMBBwo",
"oXXigwng9bPvjlh8G1moikMjH9DA",
"oXXigwltS7pHkUbtweoKa1zgRLjQ",
"oXXigwpaCPX-LADmh-rfUJwHXj9Y",
"oXXigwsazWp1CcLNs0120IOhcoI4",
"oXXigwozw9KWNGSbLHsHGXdEP3oQ",
"oXXigwuPQJjLw4VIX0L2j5yweefg",
"oXXigwuJccCbho3Xbx3LYgKzVnaE",
"oXXigwqnAmBKl94QX7KC8l_9hWOw",
"oXXigwsDP7j_7Xtq6VUKQYl7uYrw",
"oXXigwmEzQqDMR5ZUQz_OVkiZel0",
"oXXigwinZuyfTzmZLSO0W7uxYOdM",
"oXXigwnLUh8jqWjuejsYBydG2hKc",
"oXXigwpQ4iDxIkQSWgZJdq6x3PQ8",
"oXXigwnOJ01ks-kjciCj89s4CMgY",
"oXXigwiQlVT5vJMxCkHwrdvmEcDE",
"oXXigwlL5J5KeJNGPXbGyPjCgayc",
"oXXigwjLmUd3fOTBI2rK__wvwtJs",
"oXXigwu7NMr9Ql0wGuVnYFrei3dg",
"oXXigwiIT2Cg06LbDPdsfyf1yf6Y",
"oXXigwlPXxJjOYbWLcYMLzBatpEE",
"oXXigwpeOYCTHJXQSKUpdWJlR8R0",
"oXXigwkBrsHauNSLMCtNjeBidFbM",
"oXXigwlTyOSSnDrw0fVsj9XMu7wg",
"oXXigwhDzZZDHvHty18x97XI7BWw",
"oXXigwp0MO6Jst2qaIvzSZBk5MNk",
"oXXigwiQHo3c19M8OjqDkdkOStjI",
"oXXigwogmKK4BDYVENdbsptxPFrc",
"oXXigwjZjmlgwjU3fW1_wvh-NL_A",
"oXXigwgYaIUd_1PVOZp8GGCZKITw",
"oXXigwtoi2fnEG9nUUKl1_TPhbEo",
"oXXigwnl-_92Jsyz8bMWccvd_UTA",
"oXXigwqM6sCryH_dU5Ogh1MztYiE",
"oXXigwnPrFNBn_E8v2SwJa6d3NX4",
"oXXigwn1Uk68_17sZ1PBfyFnXjf8",
"oXXigwkl_EzvTfR547HKpmJxdi7o",
"oXXigwk3h7tWpdk4bJ4-HPaUm3K8",
"oXXigwiIaaZSCFb6OF6edNAMpmFI",
"oXXigwpeNZ4gbGK1-x09yZ4Ob3Kw",
"oXXigwqG0teWh-O6sme0VFT3kj5E",
"oXXigwvCLct8PnKwLn1ckZ-GFmvc",
"oXXigwodgG3xGtHBwnYNu-z-_YH4",
"oXXigwnBRFPDURYKK-p685a4rb8o",
"oXXigwr8ukRjsoRyzl_L6YDUamwI",
"oXXigwkSljevwC8jS2YaYZ6bYYyw",
"oXXigwkY7G0SgbDmh4OQJhDQnvZU",
"oXXigwrULbA825fOlCIc3nJ2ti3s",
"oXXigwvyE7-Wr7vL6HkmCqdW-YY8",
"oXXigwn1rzv5iSU54gFQ8NwzqppY",
"oXXigwpMO0A8al1Ncvjqej5D8nwY",
"oXXigwj-qG-SH7_m8QGw9EWKgXBo",
"oXXigwnEx0Rr-82v-u3xRc7hBIl4",
"oXXigwtrnjgSL8IScOteK683kMt4",
"oXXigwq1PKPnAobSHKDaURZPuZDU",
"oXXigwgok65YSu18cLOevZAEv7HY",
"oXXigwlvECCgagaBgqb84BX1zYKY",
"oXXigwicRHRLtZWI-NqS13b3hIUg",
"oXXigwkHCRE0fppQ_giBroxzbSNY",
"oXXigwqNVSsdt6n55jTRU8XOMSf4",
"oXXigwilgnrRF8_6F5Y4J4-QjvP8",
"oXXigwvxY-rIK64i5gizFqk49AUI",
"oXXigwotjnjzGPHmw3ODcCqn6XHI",
"oXXigwol9PN1wwkwF6xfYW9Xxd6w",
"oXXigwvoqdrB-eV8Sc0Pcn756aVw",
"oXXigwgLhoqvtbxpAih_oGxIT28s",
"oXXigwlMykcpoladnmK1TNEezwUs",
"oXXigwkSMaDfILeVvKHEL91rbuIw",
"oXXigwlpKYV2X9KaH4j-qvhyOw7Q",
"oXXigwkHD8CLIuymIoBtKkp1ouRs",
"oXXigwr1PgDwcBbANb9-BXlxv_Ak",
"oXXigwriA41-kLuMjkS4CSGtzwnw",
"oXXigwnnizAe8wPo1-PkNwN78EQw",
"oXXigwrfl1EpH4BxVy5AhO0K94Jk",
"oXXigwjCz3_2lPhbWZlpAjYeaT4I",
"oXXigwkeEw-_X-qweolJB9pTVxe8",
"oXXigwlJsiVo9OeQ7pIksne5-zlI",
"oXXigwnwNqTxDIQo0tXOpstj1dqA",
"oXXigwkeNGQHJBg-sNvcmdpNqpZk",
"oXXigwiFnqJe2_Y0frmMpWw4-tLA",
"oXXigwil_ht7sr7n-g9FGk72J47s",
"oXXigwomgyI8AGPnKEtQNGkeJ0SY",
"oXXigwvCGVbcSXbb0kSvcsGdSMn4",
"oXXigwqrqmSKQ_JYCmgdzKcC8VQs",
"oXXigwnYcAOPl0oMDHvJ5jDTPBi0",
"oXXigwsGScwizTyqhOwMCYn8RsLY",
"oXXigwulL2l15PXOY4Lx-N0qzsAY",
"oXXigwpdTs_nCWCnuoieR8mUmBZQ",
"oXXigwtWH_FoPSDblw5Qiq1QcQjM",
"oXXigwkftzus-oZZip51Bb4Pv_DM",
"oXXigwmlGGfpfbPQ1IjUSflos5-Q",
"oXXigwiFWDy5uu_WhEvhncNQg_AY",
"oXXigwoTqUHJXtufTDKlCE5eED6I",
"oXXigwsR0Tx1L9UBy5NkiDgT8Pns",
"oXXigwscxDoSJXY-TkYgbmF-vXRQ",
"oXXigwppMx8As49uyIEqD-LOkIsE",
"oXXigwgEqfPg0kZCgzyqWmWPHE_s",
"oXXigwgO5-21MyUswvkLYGmrY_RY",
"oXXigwpc3uLMeu3Re5RZuhBA0FEU",
"oXXigwmhl4hofCuOUCPWPD6SE5JQ",
"oXXigwrZuXQ2H0_GiylveTYJEmyo",
"oXXigwkSlstXw4-7AgOqbk7aU6zk",
"oXXigwh8iEl3JYskBbeJ2V51Jw4I",
"oXXigwiu8hHo_m1UZEXBJDF8EKSg",
"oXXigwvDuE4orsvZtyQxXWrL27lQ",
"oXXigwniF_Xd1sxSeHLzDdI8d9sA",
"oXXigwv366lp1Gt3GmHvs7U1zlLU",
"oXXigwr89m5k2R3cuvuw3OwRiZy8",
"oXXigwrHj8kFI-nrGVWe21-Up9I8",
"oXXigwu_fBtRYInaemJ32XHnZfWU",
"oXXigwsZHkz9HN2h_2aSbT2gzr8I",
"oXXigwpAz11tso6YkgaWeOj7JQ_o",
"oXXigwgxyZG4_bMNMfwxC1PJ3Quo",
"oXXigwlpJAsvZ-r4TjiQRw6xuIPo",
"oXXigwlqCNK-2N8HGva1nWsM7apY",
"oXXigwpkPIpK1LwpwlwoQ4hdNw1U",
"oXXigwrpk3Z7KlxV31aecUXTY-HU",
"oXXigwk2BD-lVIICp0M1IgG-vS-Y",
"oXXigwrt9bZwul8umW9TK-nbKvvk",
"oXXigwqKasnQxDSzjlYT62oz5L9g",
"oXXigwn3-afq28tuGtqRuDXoF9Qk",
"oXXigwkvfDHJ_-3BXGAy7XGLoIzw",
"oXXigwp6kCoBAnLf_HY8tKcooGyY",
"oXXigwohvEwhLeu_5RlkJQcwWldA",
"oXXigwjI9qlbDK0wsheyunPPwl9Y",
"oXXigwjAxPJPwko3CLD5olPCI4Gc",
"oXXigwmOocA-JVXFk52itLzDM3Zc",
"oXXigwuqwEWXRXHR_PKwVe_7peQc",
"oXXigwoJsEU4EE5y7ou9ZUf6bUw4",
"oXXigwp1gIYjB8gZp43Lz2-YZHHo",
"oXXigwpDnVNgOhoLNzgfFSuOYliU",
"oXXigwnoyAilF8yvdqt6EDw-tdzI",
"oXXigwpTcQqdCCfk2kZ-HANXhXT8",
"oXXigwhOE4A9XbSLa8JhNzZLuZFM",
"oXXigwtA-dziQ1Y-QZGvUrZemAFE",
"oXXigwgPVYlXA8Lm7IrqkMUqWfNs",
"oXXigwiypQm0r-9QridLoobm7esU",
"oXXigwrKLxyYukHXl44ZIK7CnCo4",
"oXXigwk-faXAPlJL8POHasq9KKGQ",
"oXXigwqL41b-LRIoPVbvF5sxFaMg",
"oXXigwuRq22z6ZePHaqzl2UifqIk",
"oXXigwmOqkwpo3goq9L3ZBO9oJ58",
"oXXigwn5MyX65WQHZDZsO6QL3gEk",
"oXXigwiAgcZ3xVQJlb4qyeZvicYY",
"oXXigwvJwLr9ik3Fqar5m5hMyTJ0",
"oXXigwllvpvlpFsLixXzdlcra1BQ",
"oXXigwjiWc1_dtT-ZegTUM9Ehi70",
"oXXigwqDOfRxMTjWhka28mkhlOQw",
"oXXigwnDLO0csIODmS3AB4fWMV9Y",
"oXXigwheQ9pHIzF1GR9OgOwriLGw",
"oXXigwqHo661H0bNKITHjBLJh8QI",
"oXXigwh9XlfKa2scAeOprffwqK-Q",
"oXXigwqnXS-HpGxsKBkBKyDXw0J8",
"oXXigwrUItM6kP8DqReS6pYTOAos",
"oXXigwqYOzDmO7BrdZyBif_MhPMk",
"oXXigwh3T8SDC-b3WctWYyArR7e4",
"oXXigwrhtxWDRuaqKHJjAFnL1y9s",
"oXXigwmFR0PZxoZ6hlP_gue9bMng",
"oXXigwmQvNr6IUz4DOpSI4nCz8fo",
"oXXigwujRETGFfUxzs9CASsqzLLI"
   ],
    "msgtype": "text",
    "text": { "content": "由于黄桃季节供货期的截止，2017年度云彪黄桃提货通道即将于今日（2017年8月25日）15：00关闭，如您手中还有需提货的黄桃礼券，请及时在公众号内进行提货，为您带来的不便敬请谅解，并由衷感谢您关注礼待四方的商品和服务。服务热线：18913158288"}
}
   ';

$ret = https_request("https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token=$token",$data);

echo '<html>
<body>
<h1>'.$ret.'</h1>
</body>
</html>';