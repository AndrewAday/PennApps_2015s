using UnityEngine;
using System.Collections;

public class ColumnScript : MonoBehaviour {

	public float speed = 1;

	public float lerpvar = 0;

	public float volume = 0.01f;

	public bool up = true;

	// Use this for initialization
	void Start () {

	}

	// Update is called once per frame
	void Update () {

		transform.localScale = Vector3.Lerp(new Vector3(0.01f,0.01f,0.01f),new Vector3(0.01f,volume+0.01f,0.01f),lerpvar);


		if(up)
		{
			lerpvar += Time.deltaTime * speed;
			if(lerpvar > 1)
			{
				up = false;
			}
		}
		if(!up)
		{
			lerpvar -= Time.deltaTime * speed;
			if(lerpvar < 0)
			{
				up = true;
			}
		}

	}
}
