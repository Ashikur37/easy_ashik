import 'package:commerce/screens/campaign/campaign_product_screen.dart';
import 'package:commerce/screens/campaign/campaign_screen.dart';
import 'package:commerce/screens/categories/categories_screen.dart';
import 'package:commerce/screens/search/search_screen.dart';
import 'package:commerce/screens/shop/shops_screen.dart';
import 'package:flutter/widgets.dart';
import 'package:commerce/screens/cart/cart_screen.dart';
import 'package:commerce/screens/complete_profile/complete_profile_screen.dart';
import 'package:commerce/screens/details/details_screen.dart';
import 'package:commerce/screens/forgot_password/forgot_password_screen.dart';
import 'package:commerce/screens/home/home_screen.dart';
import 'package:commerce/screens/login_success/login_success_screen.dart';
import 'package:commerce/screens/otp/otp_screen.dart';
import 'package:commerce/screens/profile/profile_screen.dart';
import 'package:commerce/screens/sign_in/sign_in_screen.dart';
import 'package:commerce/screens/splash/splash_screen.dart';

import 'screens/sign_up/sign_up_screen.dart';

// We use name route
// All our routes will be available here
final Map<String, WidgetBuilder> routes = {
  SplashScreen.routeName: (context) => SplashScreen(),
  SignInScreen.routeName: (context) => SignInScreen(),
  ForgotPasswordScreen.routeName: (context) => ForgotPasswordScreen(),
  LoginSuccessScreen.routeName: (context) => LoginSuccessScreen(),
  SignUpScreen.routeName: (context) => SignUpScreen(),
  CompleteProfileScreen.routeName: (context) => CompleteProfileScreen(),
  OtpScreen.routeName: (context) => OtpScreen(),
  HomeScreen.routeName: (context) => HomeScreen(),
  DetailsScreen.routeName: (context) => DetailsScreen(),
  CartScreen.routeName: (context) => CartScreen(),
  ProfileScreen.routeName: (context) => ProfileScreen(),
  CategoriesScreen.routeName: (context) => CategoriesScreen(),
  ShopsScreen.routeName: (context) => ShopsScreen(),
  CampaignScreen.routeName: (context) => CampaignScreen(),
  CampaignProductScreen.routeName: (context) => CampaignProductScreen(),
  SearchScreen.routeName: (context) => SearchScreen(),
};
