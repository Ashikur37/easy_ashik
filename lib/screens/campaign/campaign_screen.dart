import 'package:commerce/helper/http.dart';
import 'package:commerce/screens/campaign/campaign_product_screen.dart';
import 'package:commerce/utilities/const.dart';
import 'package:flutter/material.dart';

class CampaignScreen extends StatefulWidget {
  static String routeName = "/campaign";
  @override
  _CampaignScreenState createState() => _CampaignScreenState();
}

class _CampaignScreenState extends State<CampaignScreen> {
  List campaigns = [];
  bool isLoading = true;
  void loadCampaigns() async {
    if (isLoading) {
      var prod = await getHttp("$baseUrl/campaigns");
      setState(() {
        campaigns = prod["data"];
        isLoading = false;
      });
    }
    print(campaigns);
  }

  @override
  Widget build(BuildContext context) {
    loadCampaigns();
    return Scaffold(
      appBar: AppBar(
        title: Text("Campaign"),
      ),
      body: Column(
        children: [
          Expanded(
            child: GridView.builder(
              itemCount: campaigns.length,
              gridDelegate: SliverGridDelegateWithFixedCrossAxisCount(
                crossAxisCount: 2,
              ),
              itemBuilder: (BuildContext context, int index) {
                return GestureDetector(
                  onTap: () => Navigator.pushNamed(
                    context,
                    CampaignProductScreen.routeName,
                    arguments: CampaignProductArguments(campaigns[index]),
                  ),
                  child: Column(
                    children: [
                      Flexible(
                        child: Image.network(campaigns[index]["image"]),
                      ),
                      Text(
                        campaigns[index]["title"],
                        style: TextStyle(fontWeight: FontWeight.w600),
                      )
                    ],
                  ),
                );
                ;
              },
            ),
          ),
        ],
      ),
    );
  }
}
