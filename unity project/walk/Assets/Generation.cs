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
	// public Material red;

	// private float[] generated;
	// private float[] prevgenerated;

	int row = 0;

	// Use this for initialization
	void Start () {
		InvokeRepeating("GenerateRow", 0, 0.05F);
		// generated = new float[40];
		// prevgenerated = new float[40];
	}

	// Update is called once per frame
	void Update () {

	}

	// float Noise (int x, int y, float scale, float mag, float exp)
	// {

	//  return (int) (Mathf.Pow ((Mathf.PerlinNoise(x/scale,y/scale)*mag),(exp) ));

	// }

	void GenerateRow()
	{

		row++;

		for(int i = 0; i < 40; i++)
		{

			var block = Instantiate(cube) as Transform;
			float height = 0;

			// block.GetComponent<MeshRenderer>().material.color = new Color((i*5)/255,1,1,1);
			if(i >= 0 && i <= 6)
			{
				block.GetComponent<MeshRenderer>().material = whitebrick;
				height = 3;
			}
			if(i > 6 && i <= 7)
			{
				block.GetComponent<MeshRenderer>().material = wood;
				height = 3;
			}
			if(i > 7 && i <= 16)
			{
				block.GetComponent<MeshRenderer>().material = water;
				height = 1;
			}
			if(i > 16 && i <= 17)
			{
				block.GetComponent<MeshRenderer>().material = wood;
				height = 2;
			}
			if(i > 17 && i <= 21)
			{
				block.GetComponent<MeshRenderer>().material = brick;
				height = 2;
			}
			if(i > 21 && i <= 22)
			{
				block.GetComponent<MeshRenderer>().material = wood;
				height = 2;
			}
			if(i > 22 && i <= 31)
			{
				block.GetComponent<MeshRenderer>().material = water;
				height = 1;
			}
			if(i > 31 && i <= 32)
			{
				block.GetComponent<MeshRenderer>().material = wood;
				height = 3;
			}
			if(i > 32 && i <= 40)
			{
				block.GetComponent<MeshRenderer>().material = whitebrick;
				height = 3;
			}

			block.position = new Vector3(((i-20)/4.0f),height/4.0f,(row/4.0f));
		}

		if(Random.value < 0.1f)
		{
			var thing = Instantiate(boat) as Transform;
			thing.position = new Vector3(0.6,-2.75f + (Random.value * 0.75f),row/4.0f);
		}

		if(Random.value < 0.1f)
		{
			var thing = Instantiate(boat) as Transform;
			thing.position = new Vector3(0.6,-2.75f + (Random.value * 0.75f),row/4.0f);
		}


			if((row % 8)==0)
			{
				var thing = Instantiate(column) as Transform;
				thing.position = new Vector3(1,3.75,row/4.0f);
			}
			if((row % 8)==0)
			{
				var thing = Instantiate(column) as Transform;
				thing.position = new Vector3(1,-4.25,row/4.0f);
			}

	}
}
