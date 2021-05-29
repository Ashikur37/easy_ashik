import 'package:commerce/providers/category_provider.dart';
import 'package:flutter/material.dart';
import 'package:commerce/routes.dart';
import 'package:commerce/screens/splash/splash_screen.dart';
import 'package:commerce/theme.dart';
import 'package:provider/provider.dart';

void main() {
  runApp(MyApp());
}

class MyApp extends StatelessWidget {
  // This widget is the root of your application.
  @override
  Widget build(BuildContext context) {
    return MultiProvider(
      providers: [
        ChangeNotifierProvider(
          create: (context) => CategoryProvider(),
        )
      ],
      child: MaterialApp(
        debugShowCheckedModeBanner: false,
        title: 'Easymert',
        theme: theme(),
        // home: SplashScreen(),
        // We use routeName so that we dont need to remember the name
        initialRoute: SplashScreen.routeName,
        routes: routes,
      ),
    );
  }
}
