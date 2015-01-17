using UnityEngine;
using System.Collections;

public class MyGUI : VRGUI {

	public GUISkin skin;

	public string song;
	public int bpm;

	// Use this for initialization
	void Start () {

	}

	// Update is called once per frame
	void Update () {

	}

	public override void OnVRGUI()
	{
		GUI.skin = skin;

		// GUI.Label(new Rect(0f, 0f, 600f, 100f), "Time: " + Time.time);

		GUI.Label(new Rect(Screen.width/2 - 400, 25, 800, 100), bpm + "bpm");
		GUI.Label(new Rect(Screen.width/2 - 400, 50, 800, 100), song);
	}
}
