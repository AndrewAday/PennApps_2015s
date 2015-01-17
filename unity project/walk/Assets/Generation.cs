using UnityEngine;
using System.Collections;

public class Generation : MonoBehaviour {

	public Transform cube;

	public Material green;
	public Material red;
	public Material brick;
	public Material whitebrick;
	public Material pillar;
	public Material water;
	public Material wood;

	public Transform boat;
	public Transform column;
	public Transform bridge;
	public Transform giantboat;
	public Transform dragon;
	public Transform fishes;

	private Transform player;
	private float distancegoal = 0;
	// public Material red;

	// private float[] generated;
	// private float[] prevgenerated;

	int row = 0;

	float steprate = 0;


	void Awake()
	{
		player = GameObject.Find("OVRPlayerController").transform;
	}

	void Start()
	{
		StartCoroutine(Datas());
	}

	IEnumerator Datas () {
        var uri = "http://pennapps.gomurmur.com/bpm.php";

        var w = new WWWForm();
		w.AddField("data", "retrieve");
		w.AddField("username", "1234086604");
		// w.AddBinaryData("file", new byte[] { 65,65,65,65 });
		var r = new HTTP.Request (uri, w);
		yield return r.Send();
        Debug.Log(r.response.Text);

	}

	void OnPrivateChannel (Hashtable obj)
	{
		Debug.Log("aoidhid");
	    Debug.Log(obj);
	}


	void ChangeTint()
	{
		RenderSettings.skybox.SetColor("_Tint", Color.red);
	}

	// Update is called once per frame
	void Update () {



		while(player.position.z + 20 > distancegoal)
		{
			GenerateRow();
			distancegoal += 0.25f;
		}

	}

	// float Noise (int x, int y, float scale, float mag, float exp)
	// {

	//  return (int) (Mathf.Pow ((Mathf.PerlinNoise(x/scale,y/scale)*mag),(exp) ));

	// }

	void GenerateRow()
	{
		// GenerateMountains();
		GenerateVenice();
	}

	void GenerateVenice()
	{

		row++;
			var block = Instantiate(cube) as Transform;
			block.position = new Vector3(-5,0.75f,(row/4.0f)) + new Vector3(361,13f,0);
			// float height = 0;

			// // block.GetComponent<MeshRenderer>().material.color = new Color((i*5)/255,1,1,1);
			// if(i >= 0 && i <= 6)
			// {
			// 	block.GetChild(0).GetComponent<MeshRenderer>().material = whitebrick;
			// 	height = 3;
			// }
			// if(i > 6 && i <= 7)
			// {
			// 	block.GetChild(0).GetComponent<MeshRenderer>().material = wood;
			// 	height = 3;
			// }
			// if(i > 7 && i <= 16)
			// {
			// 	block.GetChild(0).GetComponent<MeshRenderer>().material = water;
			// 	height = 1;
			// }
			// if(i > 16 && i <= 17)
			// {
			// 	block.GetChild(0).GetComponent<MeshRenderer>().material = wood;
			// 	height = 2;
			// }
			// if(i > 17 && i <= 21)
			// {
			// 	block.GetChild(0).GetComponent<MeshRenderer>().material = brick;
			// 	height = 2;
			// }
			// if(i > 21 && i <= 22)
			// {
			// 	block.GetChild(0).GetComponent<MeshRenderer>().material = wood;
			// 	height = 2;
			// }
			// if(i > 22 && i <= 31)
			// {
			// 	block.GetChild(0).GetComponent<MeshRenderer>().material = water;
			// 	height = 1;
			// }
			// if(i > 31 && i <= 32)
			// {
			// 	block.GetChild(0).GetComponent<MeshRenderer>().material = wood;
			// 	height = 3;
			// }
			// if(i > 32 && i <= 40)
			// {
			// 	block.GetChild(0).GetComponent<MeshRenderer>().material = whitebrick;
			// 	height = 3;
			// }

			// block.position = new Vector3(((i-20)/4.0f),height/4.0f,(row/4.0f));

		if(Random.value < 0.02f)
		{
			var thing = Instantiate(boat) as Transform;
			thing.position = new Vector3(-7f + (Random.value * 5f),0.6f,row/4.0f)  + new Vector3(361,13f,0);
		}

		if(Random.value < 0.02f)
		{
			// var thing = Instantiate(bridge) as Transform;
			// thing.position = new Vector3(-2.75f + (Random.value * 0.75f),0.6f,row/4.0f);
		}

		if(Random.value < 0.02f)
		{
			var thing = Instantiate(boat) as Transform;
			thing.position = new Vector3(7 - (Random.value * 6f),0.6f,row/4.0f) + new Vector3(361,13f,0);
		}

		if(Random.value < 0.02f)
		{
			var thing = Instantiate(giantboat) as Transform;
			thing.position = new Vector3(4,3.5f,row/4.0f) + new Vector3(361,13f,0);
		}

		if(Random.value < 0.02f)
		{
			var thing = Instantiate(dragon) as Transform;
			thing.position = new Vector3(4,3.5f,row/4.0f) + new Vector3(361,13f,0);
		}

		if(Random.value < 0.005f)
		{
			var thing = Instantiate(fishes) as Transform;
			thing.position = new Vector3(4,0.6f,row/4.0f) + new Vector3(361,13f,0);
		}

		if(Random.value < 0.005f)
		{
			var thing = Instantiate(fishes) as Transform;
			thing.position = new Vector3(-4,0.6f,row/4.0f) + new Vector3(361,13f,0);
		}


		if((row % 8)==0)
		{
			var thing = Instantiate(column) as Transform;
			thing.position = new Vector3(8.75f,1,row/4.0f) + new Vector3(361,13f,0);
		}
		if((row % 8)==0)
		{
			var thing = Instantiate(column) as Transform;
			thing.position = new Vector3(-8.75f,1,row/4.0f) + new Vector3(361,13f,0);
		}

	}


	void OnGUI()
	{
		GUI.Label(new Rect(10,10,100,35),"trolololol");
	}

	void GenerateMountains()
	{

		row++;

		for(int i = 0; i < 40; i++)
		{

			var block = Instantiate(cube) as Transform;
			float height = 0;

			block.GetComponent<MeshRenderer>().material = pillar;


			block.position = new Vector3(((i-20)/4.0f),1/4.0f,(row/4.0f));
		}

		if(Random.value < 0.02f)
		{
			var thing = Instantiate(boat) as Transform;
			thing.position = new Vector3(-2.75f + (Random.value * 0.75f),0.6f,row/4.0f);
		}

		if(Random.value < 0.02f)
		{
			var thing = Instantiate(boat) as Transform;
			thing.position = new Vector3(1 + (Random.value * 0.75f),0.6f,row/4.0f);
		}


			if((row % 8)==0)
			{
				var thing = Instantiate(column) as Transform;
				thing.position = new Vector3(3.75f,1,row/4.0f);
			}
			if((row % 8)==0)
			{
				var thing = Instantiate(column) as Transform;
				thing.position = new Vector3(-4.25f,1,row/4.0f);
			}

	}
}
